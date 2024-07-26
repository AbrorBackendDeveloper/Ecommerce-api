<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\AdminOrderController;

Route::prefix('stats')->group(function () {
    
    Route::get('orders-count', [StatsController::class, 'ordersCount']);
    Route::get('orders-sales-sum', [StatsController::class, 'ordersSalesSum']);
    Route::get('orders-count-by-days', [StatsController::class, 'OrdersCountByDays']);
    Route::get('delivery-method-ratio', [StatsController::class, 'DeliveryMethodRatio']);
    
});

Route::apiResource('orders', AdminOrderController::class);