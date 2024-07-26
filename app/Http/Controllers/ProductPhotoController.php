<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Http\Requests\StoreProductPhotoRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductPhotoController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }

    public function index(Product $product) {
        return $this->response($product->photos);
    }

    
    public function store(StoreProductPhotoRequest $request, Product $product)
    {
        foreach ($request->photos as $photo) {
            $path = $photo->store('products/'.$product->id, 'public');
            $fullName = $photo->getClientOriginalName();
            
            $product->photos()->create([
                'full_name'=> $fullName,
                'path' => $path
            ]);
        }

        return $this->success('photo added');
    }

    
    public function destroy(Product $product, Photo $photo) 
    {
        // Gate::authorize('product:delete');
        
        Storage::delete($photo->path);
        $photo->delete();

        return $this->success('photo deleted');
    }
}
