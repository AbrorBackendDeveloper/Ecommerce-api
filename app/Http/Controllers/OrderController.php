<?php

namespace App\Http\Controllers;

use OrderService;
use ProductService;
use App\Models\Order;
use App\Models\UserAddress;
use App\Models\DeliveryMethod;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class OrderController extends Controller implements HasMiddleware
{
    protected OrderService $orderService;
    protected ProductService $productService;


    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }

    public function __construct()
    {
        $this->orderService = app(OrderService::class);
        $this->productService = app(ProductService::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->has('status_id')) {
            return $this->response(OrderResource::collection(auth()->user()->orders()->where('status_id', request('status_id'))->paginate(10)));
        }
        return $this->response(OrderResource::collection(auth()->user()->orders()->paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        // Gate::authorize('create:order', Order::class);
        
        // o'zgaruvchilarni belgilash
        list($sum, $products, $notFoundProducts, $address, $deliveryMethod) = $this->defineVariables($request);

        //omborda product bor yo'qligini tekshirish
        list($sum, $products, $notFoundProducts) = $this->productService->checkForStock($request['products'], $sum, $products, $notFoundProducts);

        //bor bo'lsa buyurtma yaratish
        if ($notFoundProducts == [] && $products !== [] && $sum !== 0) {
            $order = $this->orderService->saveOrder($deliveryMethod, $sum, $request, $address, $products);
            return $this->success('order created', $order);
        }
        return $this->error(
            'some products not found or does not haave in inventory',
            ['not_found_products' => $notFoundProducts]
        );
    }

    public function show(Order $order)
    {
        return $this->response(new OrderResource($order));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        Gate::authorize('delete:order', $order);
        $order->delete();

        return 2;
    }

    public function defineVariables(StoreOrderRequest $request)
    {
        $sum = 0;
        $products = [];
        $notFoundProducts = [];
        $address = UserAddress::find($request->address_id);
        $deliveryMethod = DeliveryMethod::findOrFail($request->delivery_method_id);
        return array($sum, $products, $notFoundProducts, $address, $deliveryMethod);
    }
}
