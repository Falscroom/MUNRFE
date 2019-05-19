<?php


namespace App\Http\Controllers\Admin\Core;

use Exception;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerMediaController as BaseVoyagerMediaController;
use App\Http\Controllers\Admin\ContentTypes\Image;

class VoyagerMediaController extends BaseVoyagerMediaController
{
    const OPTIONS = '{
            "quality" : "75",
            "thumbnails": [
                {
                    "name": "preview",
                    "scale" : "100%",
                    "resize" : {
                        "height" : "200"
                    }
                }
            ]
        }';

    public function upload(Request $request)
    {
        // Check permission
        $this->authorize('browse_media');

        if(in_array($request->file->getClientOriginalExtension(), ['jpeg','jpg','png'])) {
            try {
                $image = new Image($request, $request->upload_path, null, json_decode(self::OPTIONS));
                $image->handle();

                $success = true;
                $message = __('voyager::media.success_uploaded_file');
                $path = preg_replace('/^public\//', '', $request->upload_path);

            } catch (Exception $e) {
                $success = false;
                $message = $e->getMessage();
                $path = '';
            }
        } else {
            return parent::upload($request);
        }


        return response()->json(compact('success', 'message', 'path'));
    }



}