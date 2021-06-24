<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use \App\Product;
use \App\Http\Requests\SaveProductRequest;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $search = preg_split("/[\s,]+/", $request->search);
        $products = Product::where('active', true)
                    ->where(function ($query) use ($search) {
                        foreach ($search as $word){
                            $query->where(function ($sub_query) use ($word) {
                                $sub_query->where('title', 'like', '%'.$word.'%')->orWhere('description', 'like', '%'.$word.'%');
                            });
                        }
                    })
                    ->whereBetween('price', [$request->min_price ?? 0, $request->max_price ?? INF])
                    ->Where('category_id', 'like', $request->category ?? '%')
                    ->Where('type', 'like', $request->type ?? '%')
                    ->Where('category_id', 'like', $request->category ?? '%')
                    ->latest()
                    ->paginate($request->paginate ?? 5);

        return view('product.products', ['products' => $products, 'search' => $request ]);
    }


    public function store(SaveProductRequest $request)
    {
        $product = Auth::user()->products()->create($request->all());

        $product->cover_product_image_id = ($request->cover_image ?? ($request->images[0] ?? null));
        $product->syncImages($request->product_images ?? []);

        $product->save();

        return redirect()->route('product.product', [ 'id' => $product->id ]);
    }

    public function edit($id)
    {
        $product = Auth::user()->products()->findOrFail($id);

        return view('product.product_edit', ['product' => $product ]);
    }

    public function create()
    {
        $product = new Product();

        return view('product.product_edit', ['product' => $product ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.product', ['product' => $product]);
    }

    public function update(SaveProductRequest $request, $id)
    {
        $product = Auth::user()->products()->findOrFail($id);

        $product->update($request->all() ?? []);
        $product->cover_product_image_id = $request->cover_image ?? $request->product_images[0] ?? null;
        $product->syncImages($request->product_images ?? []);

        $product->save();

        return redirect()->route('product.product', [ 'id' => $product->id ]);


    }


    public function destroy($id)
    {
        $product = Auth::user()->products()->findOrFail($id);

        $product->delete();
    }


    public function activate(Request $request, $id){
        $product = $product = Auth::user()->products()->findOrFail($id);

        if ($product->active != true){
            $product->active = true;
            $product->save();
        }

        return redirect()->route('product.product', [ 'id' => $product->id ]);
    }

    public function deactivate(Request $request, $id){
        $product = $product = Auth::user()->products()->findOrFail($id);

        if ($product->active != false){
            $product->active = false;
            $product->save();
        }

        return redirect()->route('product.product', [ 'id' => $product->id ]);
    }

}
