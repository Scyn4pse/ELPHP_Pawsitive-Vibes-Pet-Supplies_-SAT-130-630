<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function addToOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cust_id' => 'required|exists:Customers,id',
            'order_item_id' => 'required|exists:OrderItems,id',
            'total_amount' => 'required|numeric|min:0',
            'order_date' => 'required|date',
            'order_status' => 'required|in:pending,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    public function getOrder($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }
    public function getAllOrders(){
        $orders = Order::all();
        return response()->json($orders);
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'cust_id' => 'sometimes|required|exists:Customers,id',
            'order_item_id' => 'sometimes|required|exists:OrderItems,id',
            'total_amount' => 'sometimes|required|numeric|min:0',
            'order_date' => 'sometimes|required|date',
            'order_status' => 'sometimes|required|in:pending,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $order->update($request->only(['cust_id', 'order_item_id', 'total_amount', 'order_date', 'order_status']));

        return response()->json($order);
    }
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(null, 204);
    }
}
