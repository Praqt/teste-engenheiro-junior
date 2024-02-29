<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order){
        $this->order = $order;
    }

    public function createOrder(Request $request) {
        return $this->order->createOrder(auth()->user()->id, $request->all());
    }

    public function showUserOrders() {
        return $this->order->showUserOrders(auth()->user()->id);
    }

    public function updateOrder($orderId, Request $request) {
        return $this->order->updateOrder(auth()->user()->id, $orderId, $request->all());
    }

    public function deleteOrder($orderId) {
        return $this->order->deleteOrder($orderId);
    }
}
