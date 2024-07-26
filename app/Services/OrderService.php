<?php

use App\Services\Service;
use App\Http\Requests\StoreOrderRequest;

class OrderService extends Service
{
    protected OrderRepository $orderRepository;
    protected StockRepository $stockRepository;

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
        $this->stockRepository = app(StockRepository::class);
    }
    public function saveOrder($deliveryMethod, $sum, StoreOrderRequest $request, $address, array $products)
    {
        $sum += $deliveryMethod->sum;
        $order = $this->orderRepository->createOrder($request, $sum, $address, $products);

        if ($order) {
            $this->stockRepository->subtractFromStock($products);
        }
        return $order;
    }
}