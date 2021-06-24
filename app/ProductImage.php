<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use \File;
use Intervention\Image\ImageManagerStatic as Image;

class ProductImage extends Model
{

    static $path = 'images/product-image/';

    public $timestamps = [ "created_at" ];

    protected $fillable = [
        'id', 'product_id', 'image', 'created_at'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public static function storeImage($file){
        if (!$file){
            return null;
        }

        $path = self::$path;
        $path = public_path($path);

        $filename = time() . str_random(rand(8, 32));
        $extension = '.' . $file->getClientOriginalExtension();

        $image = Image::make($file);
        $image->resize(null, 720, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save( $path . $filename . $extension);
        $image->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save( $path . $filename . '-small' . $extension);

        $productImage = ProductImage::create([
            'image' => $filename . $extension,
        ]);

        return $productImage;
    }

    public function deleteImage()
    {
        $path = self::$path;
        $path = public_path($path);

        $file = pathinfo($this->image);
        foreach([
            $path . $file['filename'] . '.' . $file['extension'],
            $path . $file['filename'] . '-small' . '.' . $file['extension'],
        ] as $item){
            if(File::exists($item)) {
                File::delete($item);
            }
        }

        $this->delete();

        return true;
    }

    public function getUrlAttribute()
    {
        return $this->url('normal');
    }

    public function getUrlSmallAttribute()
    {
        return $this->url('small');
    }

    public function url($size = 'normal')
    {
        $image = $this->image;

        if(!$image){
            return null;
        }

        $folder = self::$path;
        $file = pathinfo($image);

        if ($size == 'small'){
            return url($folder . $file['filename'] . '-small' . '.' . $file['extension']);
        }
        else {
            return url($folder . $file['filename'] . '.' . $file['extension']);
        }
    }

}
