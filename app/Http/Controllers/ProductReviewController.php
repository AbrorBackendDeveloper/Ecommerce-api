<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductReviewController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth:sanctum',
        ];
    }

    
    public function index(Product $product)
    {

        return $this->response([
            'overall_rating' => round($product->reviews()->avg('rating'), 1),
            'reviews_count' => $product->reviews()->count(),
            'reviews' => $product->reviews()->with('user')->paginate(10)
        ]);
    }

    public function store(Product $product, StoreReviewRequest $request)
    {
        $review = $product->reviews()->create([
            'user_id' => auth()->user()->id,
            'rating' => $request->rating,
            'body' => $request->body,
        ]);

        
        return $this->success('review created', $review);
    }
}
