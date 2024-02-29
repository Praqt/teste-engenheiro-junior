<?php

use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard',  [DashboardController::class, "index"])->name("dashboard");


    Route::get("/dashboard/clients", [ClientController::class, "index"])->name("dashboard.clients");
    Route::get("/dashboard/clients/create", [ClientController::class, "create"])->name("dashboard.clients.create");
    Route::get("/dashboard/clients/{id}", [ClientController::class, "show"])->name("dashboard.clients.show");
    Route::get("/dashboard/clients/{id}/edit", [ClientController::class, "edit"])->name("dashboard.clients.edit");

    Route::post("/dashboard/clients", [ClientController::class, "store"])->name("dashboard.clients.store");
    Route::put("/dashboard/clients/{id}/update", [ClientController::class, "update"])->name("dashboard.clients.update");

    Route::delete("/dashboard/clients/{id}", [ClientController::class, "destroy"])->name("dashboard.clients.destroy");


    Route::get("/dashboard/products", [ProductController::class, "index"])->name("dashboard.products");
    Route::get("/dashboard/products/create", [ProductController::class, "create"])->name("dashboard.products.create");
    Route::get("/dashboard/products/{id}", [ProductController::class, "show"])->name("dashboard.products.show");
    Route::get("/dashboard/products/{id}/edit", [ProductController::class, "edit"])->name("dashboard.products.edit");

    Route::post("/dashboard/products", [ProductController::class, "store"])->name("dashboard.products.store");
    Route::put("/dashboard/products/{id}/update", [ProductController::class, "update"])->name("dashboard.products.update");

    Route::delete("/dashboard/products/{id}", [ProductController::class, "destroy"])->name("dashboard.products.destroy");


    Route::get("/dashboard/orders", [OrderController::class, "index"])->name("dashboard.orders");
    Route::get("/dashboard/orders/create", [OrderController::class, "create"])->name("dashboard.orders.create");
    Route::get("/dashboard/orders/{id}", [OrderController::class, "show"])->name("dashboard.orders.show");
    Route::get("/dashboard/orders/{id}/edit", [OrderController::class, "edit"])->name("dashboard.orders.edit");

    Route::post("/dashboard/{id}/orders", [OrderController::class, "store"])->name("dashboard.orders.store");
    Route::put("/dashboard/orders/{id}/update", [OrderController::class, "update"])->name("dashboard.orders.update");

    Route::delete("/dashboard/orders/{id}", [OrderController::class, "destroy"])->name("dashboard.orders.destroy");


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
