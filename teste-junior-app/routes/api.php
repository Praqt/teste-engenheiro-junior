<?php

use App\Http\Controllers\ClientController;
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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clients', [ClientController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/orders', [OrderController::class, 'index']);

Route::delete('delete/orders/{uuid}', [OrderController::class, 'destroy']);

Route::delete('delete/products/{uuid}', [ProductController::class, 'destroy']);

Route::delete('delete/clients/{uuid}', [ClientController::class, 'destroy']);
