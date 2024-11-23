<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'cust_id' => 'required|exists:customers,id',
            'order_item_id' => 'required|exists:order_items,id',
            'total_amount' => 'required|numeric',
            'order_date' => 'required|date',
            'order_status' => 'required|in:pending,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

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
