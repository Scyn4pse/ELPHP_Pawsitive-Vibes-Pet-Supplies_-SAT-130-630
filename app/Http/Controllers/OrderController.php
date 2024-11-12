<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Get all orders
    public function index()
    {
        return response()->json(Order::all());
    }

    // Create a new order
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric',
        ]);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    // Get a specific order
    public function show($id)
    {
        return response()->json(Order::findOrFail($id));
    }

    // Update order details
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order);
    }

    // Delete order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}
