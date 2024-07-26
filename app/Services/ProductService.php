<?php

use App\Models\Product;
use App\Services\Service;
use App\Http\Resources\ProductResource;

class ProductService extends Service
{
    public function checkForStock($products1, mixed $sum, array $products, array $notFoundProducts)
    {
                foreach ($products1['products'] as $requestProduct) {
            $product = Product::with('stocks')->find($requestProduct['product_id']);
            $product->quantity = $requestProduct['quantity'];

            if (
                $product->stocks()->find(['stock_id']) &&
                $product->stocks()->find($requestProduct['stock_id'])->quantity >= $requestProduct['quantity']
            ) {
                $productWithStock = $product->withStock($requestProduct['stock_id']);
                $productResource = (new ProductResource($productWithStock))->resolve();

                $sum += $productResource['discountprice'] ?? $productResource['price'];
                $sum += $productWithStock->stocks[0]->added_price;
                $products[] = $productResource;

            } else {
                $requestProduct['we_have'] = $product->stocks()->find($requestProduct['stock_id'])->quantity;
                $notFoundProducts[] = $requestProduct;
            }
        }
    }
}