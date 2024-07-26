<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductController extends Controller implements HasMiddleware
{


    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::cursorPaginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->toArray());

        return $this->success('product cerated', new ProductResource($product));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource( Product::with('stocks')->findOrFail($product->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
        Storage::delete($product->photos()->pluck('path')->toArray());
        $product->photos()->delete();
        $product->delete();

        return $this->success('product deleted');
    }

    
    public function related(Product $product)
    {
        return $this->response(
            ProductResource::collection(
                Product::query()
                ->where('category_id', $product->category_id)
                ->limit(20)
                ->get())
        );
    }
}
