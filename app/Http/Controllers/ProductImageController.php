<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use \App\ProductImage;
use \File;
use Intervention\Image\ImageManagerStatic as Image;

class ProductImageController extends Controller
{

    protected $path = 'images/product-image/';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')){
            $productImage = ProductImage::storeImage($request->file('file'));

            return response()->json([
                'id' => $productImage->id,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $productImage = ProductImage::findOrFail($request->id);

        if($productImage){
            $productImage->deleteImage();
        }

        return '';
    }

}
