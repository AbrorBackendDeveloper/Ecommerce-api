<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray(Request $request): array
    {


        $product = new Product();
        $discount = $product->getDiscount();

        if ($discount) {
            if ($discount->sum) {
                $discountedPrice = $product->price - $discount->sum;
            } elseif ($discount->percent) {
                $discountedPrice = $product->price * ((100 - $discount->percent) / 100);
            }
        } else {
            // Discount mavjud emasligi holati
            $discountedPrice = $product->price;
        }
        
        return [    
            "id"=> $this->id,
            'name' => $this->getTranslations('name'),
            'price' => $this->price,
            'description' => $this->getTranslations('description'),
            'inventory' => StockResource::collection($this->stocks),
            'category' => new CategoryResource($this->category),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'order_quantity' => $this->when(isset($this->quantity), $this->quantity),
            'photos' => PhotoResource::collection($this->photos),
            'discount' => $this->getDiscount()
        ];
    }
}
