<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'product_id', 
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function createOrder($userId, $data) {
        
        return $this->create([
            'user_id' => $userId,
            'product_id' => $data['product_id'],
            'status' => 'em_espera'
        ]);
    }

    public function showUserOrders($userId) {
        return $this->where('user_id', $userId)->with('product')->get();
    }

    public function updateOrder($userId, $orderId, $data) {
        $order = $this->find($orderId);
        
        if(!empty($data['product_id'])) {
            $order->product_id = $data['product_id'];
        }

        if(!empty($data['product_id'])) {
            $order->status = $data['status'];
        }

        return $order->save();
       
    }

    public function deleteOrder($orderId) {
        $order = $this->find($orderId);
        return $order->delete();
    }

}
