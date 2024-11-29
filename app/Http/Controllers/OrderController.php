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
    public function addToOrder(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'cust_id' => 'required|exists:customers,id',
            'order_item_id' => 'required|exists:order_items,id',
            'total_amount' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'order_status' => 'required|in:pending,completed,cancelled',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create the order
        $order = Order::create($request->all());

        // Return the created order with a success response
        return response()->json($order, 201);
    }

    // Get a specific order
    public function getOrder($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }
    public function getAllOrders(){
        $orders = Order::all();
        return response()->json($orders);
    }

    // Update order details
    public function updateOrder(Request $request, $id)
    {
        // Find the order by ID or fail
        $order = Order::findOrFail($id);

        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'cust_id' => 'sometimes|required|exists:customers,id',
            'order_item_id' => 'sometimes|required|exists:order_items,id',
            'total_amount' => 'sometimes|required|numeric|min:0',
            'order_date' => 'sometimes|required|date',
            'order_status' => 'sometimes|required|in:pending,completed,cancelled',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update the order with validated data
        $order->update($request->only(['cust_id', 'order_item_id', 'total_amount', 'order_date', 'order_status']));

        // Return the updated order with a success response
        return response()->json($order);
    }

    // Delete order
    public function deleteOrder($id)
    {
        // Find the order by ID or fail
        $order = Order::findOrFail($id);
        $order->delete();

        // Return a 204 No Content response
        return response()->json(null, 204);
    }
}
