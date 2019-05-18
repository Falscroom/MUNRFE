<?php

namespace App\Http\Controllers\Admin;

use App\MunrfePost;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Core\VoyagerBaseController;

class MunrfePostAdminController extends VoyagerBaseController
{
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        $this->authorize('add', app($dataType->model_name));

        $this->validateBread($request->all(), $dataType->addRows)->validate();
        $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    /***
     * @param $request Request
     * @param $slug string
     * @param $rows Collection
     * @param $model MunrfePost
     * @return MunrfePost
    */
    public function insertUpdateData($request, $slug, $rows, $model)
    {
        $multi_select = [];
        $filesystem = config('voyager.storage.disk');
        $realPath = Storage::disk($filesystem)->getDriver()->getAdapter()->getPathPrefix();

        $translations = is_bread_translatable($model)
            ? $model->prepareTranslations($request)
            : [];

        foreach ($rows as $row) {
            if (!$request->hasFile($row->field) && !$request->has($row->field) && $row->type !== 'checkbox') {
                if (isset($row->details->type) && $row->details->type !== 'belongsToMany') {
                    continue;
                }
            }

            $content = $this->getContentBasedOnType($request, $slug, $row, $row->details);

            if ($row->type == 'relationship' && $row->details->type != 'belongsToMany') {
                $row->field = @$row->details->column;
            }

            if ($row->type == 'multiple_images' && !is_null($content)) {
                if (isset($model->{$row->field})) {
                    $ex_files = json_decode($model->{$row->field}, true);
                    if (!is_null($ex_files)) {
                        $content = json_encode(array_merge($ex_files, json_decode($content)));
                    }
                }
            }

            if (is_null($content)) {

                // If the image upload is null and it has a current image keep the current image
                if ($row->type == 'image' && is_null($request->input($row->field)) && isset($model->{$row->field})) {
                    $content = $model->{$row->field};
                }

                // If the multiple_images upload is null and it has a current image keep the current image
                if ($row->type == 'multiple_images' && is_null($request->input($row->field)) && isset($model->{$row->field})) {
                    $content = $model->{$row->field};
                }

                // If the file upload is null and it has a current file keep the current file
                if ($row->type == 'file') {
                    $content = $model->{$row->field};
                }

                if ($row->type == 'password') {
                    $content = $model->{$row->field};
                }
            }

            if ($row->type == 'relationship' && $row->details->type == 'belongsToMany') {
                // Only if select_multiple is working with a relationship
                $multi_select[] = ['model' => $row->details->model, 'content' => $content, 'table' => $row->details->pivot_table];
            } else {
                if($row->field == 'gallery') {
                    $images = json_decode($content);
                    $dimensions = [];
                    foreach ($images as $image) {
                        $dimensions[] = ImageHelper::getDimensions($realPath . $image);
                    }
                    $model->gallery_dimensions = json_encode($dimensions);
                }
                $model->{$row->field} = $content;
            }
        }

        if (isset($model->additional_attributes)) {
            foreach ($model->additional_attributes as $attr) {
                if ($request->has($attr)) {
                    $model->{$attr} = $request->{$attr};
                }
            }
        }

        $model->save();

        // Save translations
        if (count($translations) > 0) {
            $model->saveTranslations($translations);
        }

        foreach ($multi_select as $sync_data) {
            $model->belongsToMany($sync_data['model'], $sync_data['table'])->sync($sync_data['content']);
        }

        // Rename folders for newly created data through media-picker
        if ($request->session()->has($slug.'_path') || $request->session()->has($slug.'_uuid')) {
            $old_path = $request->session()->get($slug.'_path');
            $uuid = $request->session()->get($slug.'_uuid');
            $new_path = str_replace($uuid, $model->getKey(), $old_path);
            $folder_path = substr($old_path, 0, strpos($old_path, $uuid)).$uuid;

            $rows->where('type', 'media_picker')->each(function ($row) use ($model, $uuid) {
                $model->{$row->field} = str_replace($uuid, $model->getKey(), $model->{$row->field});
            });
            $model->save();
            if ($old_path != $new_path && !Storage::disk(config('voyager.storage.disk'))->exists($new_path)) {
                $request->session()->forget([$slug.'_path', $slug.'_uuid']);
                Storage::disk(config('voyager.storage.disk'))->move($old_path, $new_path);
                Storage::disk(config('voyager.storage.disk'))->deleteDirectory($folder_path);
            }
        }

        return $model;
    }
}