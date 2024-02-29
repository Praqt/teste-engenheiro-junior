<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource("/products", ProductController::class);
Route::apiResource("/clients", ClientController::class);
Route::apiResource("/orders", OrderController::class);
Route::get("/orders/{id}/client", [OrderController::class, "client"]);