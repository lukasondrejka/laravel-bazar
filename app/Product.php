<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','cover_product_image_id' , 'title', 'description', 'photo', 'price', 'type', 'active',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function coverImage()
    {
        return $this->belongsTo('App\ProductImage', 'cover_product_image_id');
    }

    public function images()
    {
        return $this->hasMany('App\ProductImage');
    }

    public function getRichDescriptionAttribute()
    {
        return  nl2br(preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a target="_blank" href="$1">$1</a> ', e($this->description) . " "));
    }

    public function getTeaserAttribute()
    {
        return str_limit($this->description, $limit = 230, $end = '...');
    }

    public function getFormatedPriceAttribute()
    {
        if ($this->price == ((int) $this->price)) {
            return number_format((int) $this->price, 0, '.', ' ');
        } else {
            return number_format($this->price, 2, '.', ' ');
        }
    }

    public function getCreatedDateAttribute()
    {
        return date('j.n.Y', strtotime($this->created_at));
    }

    public function getUpdatedDateAttribute()
    {
        return date('j.n.Y', strtotime($this->updated_at));
    }


    public function syncImages($new_images)
    {
        $old_images = $this->images->pluck('id')->toArray() ?? [];
        $new_images = $new_images ?? [];

        // Remove images
        foreach (array_values(array_diff($old_images, $new_images)) as $image)
        {
            $productImage = \App\ProductImage::findOrFail($image);

            if($productImage){
                $productImage->deleteImage();
            }
        }

        // Add images
        foreach (array_values(array_diff($new_images, $old_images)) as $image)
        {
            $productImage = \App\ProductImage::findOrFail($image);

            $productImage->product_id = $this->id;
            $productImage->save();
        }

    }

}
