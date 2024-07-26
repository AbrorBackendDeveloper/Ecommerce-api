<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use OrderRepository;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\OrderResource;
use Illuminate\Routing\Controllers\HasMiddleware;

class AdminOrderController extends Controller implements HasMiddleware
{

    protected OrderRepository $orderRepository;

    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
    }
    
    public function index(Request $request)
    {

        Gate::authorize('order:viewAny');
        $orders = $this->orderRepository->getAll($request);

        return OrderResource::collection($orders);
       
        
    }
}
