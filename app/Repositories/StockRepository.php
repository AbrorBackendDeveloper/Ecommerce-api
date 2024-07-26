<?php

use App\Models\Stock;
use App\Repositories\Repository;

class StockRepository extends Repository
{
    public function subtractFromStock(array $products)
    {
        foreach ($products as $product){
            $stock = Stock::find($product['inventory'][0]['id']);
            $stock->quantity -= $product['order_quantity'];
            $stock->save();
        }
    }
}
