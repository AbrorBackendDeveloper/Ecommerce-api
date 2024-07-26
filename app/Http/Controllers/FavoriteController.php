<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class FavoriteController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth:sanctum',
        ];
    }
    
    public function index()
    {
        return auth()->user()->favorites()->paginate(20);
    }

    public function store(Request $request): JsonResponse
    {
        auth()->user()->favorites()->attach($request->product_id);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($favorite_id)
    {
        if(auth()->user()->hasFavorite($favorite_id)){
            auth()->user()->favorites()->detach($favorite_id);

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json(['success' => false, 'message' => 'favorite does not exist in this user']);
    }
}
