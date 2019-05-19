<?php

namespace App;

use phpDocumentor\Reflection\Types\Integer;
use TCG\Voyager\Traits\Resizable;
use Illuminate\Database\Eloquent\Model;


/**
 * App\MunrfePost
 *
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $content
 * @property string $gallery
 * @property int|null $type_id
 * @property int|null $category_id
 * @property int|null $user_id
 * @property int|null $meta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereJsonGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereMetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereUserId($value)
 * @mixin \Eloquent
 * @property string $gallery_dimensions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MunrfePost whereGalleryDimensions($value)
 */
class MunrfePost extends Model
{
    use Resizable;

    /**
     * @var array
     */
    private $dimensions;

    /**
     * @param int $key
     * @return string
     */
    public function getWidth(int $key) {
        if (!$this->dimensions) {
            $this->dimensions = json_decode($this->gallery_dimensions);
        }
        return ($this->dimensions)[$key][0];
    }

    /**
     * @param int $key
     * @return string
     */
    public function getHeight(int $key) {
        if (!$this->dimensions) {
            $this->dimensions = json_decode($this->gallery_dimensions);
        }
        return ($this->dimensions)[$key][1];
    }
}
