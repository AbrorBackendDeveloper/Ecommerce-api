<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserPhotoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\ProductPhotoController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\PaymentCardTypeController;
use App\Http\Controllers\UserPaymentCardsController;

Route::post('roles/assign', [RoleController::class, 'assign']);
Route::post('permissions/assign', [PermissionController::class, 'assign']);
Route::get('products/{product}/related', [ProductController::class, 'related']);

Route::apiResources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'orders' => OrderController::class,
    'reviews' => ReviewController::class,
    'statuses' => StatusController::class,
    'settings' => SettingController::class,
    'products' => ProductController::class,
    'categories'=> CategoryController::class,
    'favorites' => FavoriteController::class,
    'discounts' => DiscountController::class,
    'permissions' => PermissionController::class,
    'users.photos' => UserPhotoController::class,
    'payment_types' => PaymentTypeController::class,
    'user_settings' => UserSettingController::class,
    'user_addresses' => UserAddressController::class,
    'statuses.orders' => StatusOrderController::class,
    'products.photos' => ProductPhotoController::class,
    'products.reviews' => ProductReviewController::class,
    'delivery_methods' => DeliveryMethodController::class,
    'payment_card_types' => PaymentCardTypeController::class,
    'categories.products' => CategoryProductController::class,  //chiroyliroq qilib ketma-ketligini
    'user_payment_cards' => UserPaymentCardsController::class,
]);
