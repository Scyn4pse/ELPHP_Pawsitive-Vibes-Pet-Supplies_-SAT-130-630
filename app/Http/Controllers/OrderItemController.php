<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    // Get all order items
    public function index()
    {
        return response()->json(OrderItem::all());
    }

    // Create a new order item
    // Store a new order item
    public function addToOrderItem(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'prod_id' => 'required|exists:products,id',
            'order_item_quantity' => 'required|integer|min:1', // Ensure quantity is at least 1
            'order_item_price' => 'required|numeric|min:0', // Ensure price is non-negative
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create the order item
        $orderItem = OrderItem::create($request->only(['prod_id', 'order_item_quantity', 'order_item_price']));

        // Return the created order item with a success response
        return response()->json($orderItem, 201);
    }

    // Get a specific order item
    public function getOrderItem($id)
    {
        // Find the order item by ID or fail
        $orderItem = OrderItem::findOrFail($id);
        return response()->json($orderItem);
    }
    public function getAllOrderItems()
    {
        $orderItems = OrderItem::all();
        return response()->json($orderItems);
    }

    // Update order item details
    public function updateOrderItems(Request $request, $id)
    {
        // Find the order item by ID or fail
        $orderItem = OrderItem::findOrFail($id);

        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'prod_id' => 'sometimes|required|exists:products,id',
            'order_item_quantity' => 'sometimes|required|integer|min:1',
            'order_item_price' => 'sometimes|required|numeric|min:0',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update the order item with validated data
        $orderItem->update($request->only(['prod_id', 'order_item_quantity', 'order_item_price']));

        // Return the updated order item with a success response
        return response()->json($orderItem);
    }

    // Delete order item
    public function deleteOrderItems($id)
    {
        // Find the order item by ID or fail
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        // Return a 204 No Content response
        return response()->json(null, 204);
    }
}

