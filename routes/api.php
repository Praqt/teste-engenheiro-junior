<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {
    Route::post('me', [AuthController::class, 'userProfile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    //Products
    Route::get('products/list', [ProductController::class, 'getProductsList']);
    Route::post('products/create', [ProductController::class, 'create']);
    Route::delete('products/delete/{id}', [ProductController::class, 'delete']);
    Route::put('products/update/{id}', [ProductController::class, 'update']);
    
    //Orders
    Route::post('orders/create', [OrderController::class, 'createOrder']);
    Route::get('orders/show', [OrderController::class, 'showUserOrders']);
    Route::put('orders/update/{orderId}', [OrderController::class, 'updateOrder']);
    Route::delete('orders/delete/{orderId}', [OrderController::class, 'deleteOrder']);

});