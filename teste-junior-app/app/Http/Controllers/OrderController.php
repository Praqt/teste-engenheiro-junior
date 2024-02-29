<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::all();
        $orders = $orders->sortByDesc('created_at');

        $ordersData = $orders->map(function ($order) {
            $clientName = $order->client->name ?? null;
            $orderData = $order->toArray();
            $orderData['client'] = $clientName;
            return $orderData;
        });

        $ordersData = $ordersData->sortByDesc('created_at');

        return response()->json($ordersData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_uuid' => 'required',
            'status' => 'status',
        ]);

        $order = new Order();
        $order->client_uuid = $request->input('client_uuid');
        $order->status = $request->input('status');

        $order->save();

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     **/
    public function show($uuid)
    {
        $order = Order::findOrFail($uuid);
        return response()->json($order);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $order = Order::findOrFail($uuid);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'client_uuid' => 'required',
            'status' => 'status',
        ]);

        $order = Order::find($uuid);
        $order->update($request->all());

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
