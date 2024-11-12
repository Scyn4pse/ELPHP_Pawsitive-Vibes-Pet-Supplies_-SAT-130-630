<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Get all order items
    public function index()
    {
        return response()->json(OrderItem::all());
    }

    // Create a new order item
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
        ]);

        $orderItem = OrderItem::create($request->all());
        return response()->json($orderItem, 201);
    }

    // Get a specific order item
    public function show($id)
    {
        return response()->json(OrderItem::findOrFail($id));
    }

    // Update order item details
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($request->all());
        return response()->json($orderItem);
    }

    // Delete order item
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
        return response()->json(null, 204);
    }
}

