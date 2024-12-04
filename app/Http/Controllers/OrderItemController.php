<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    public function index()
    {
        return response()->json(OrderItem::all());
    }

    public function addToOrderItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_id' => 'required|exists:Products,id',
            'order_item_quantity' => 'required|integer|min:1', 
            'order_item_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

      
        $orderItem = OrderItem::create($request->only(['prod_id', 'order_item_quantity', 'order_item_price']));

        return response()->json($orderItem, 201);
    }

    public function getOrderItem($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        return response()->json($orderItem);
    }
    public function getAllOrderItems()
    {
        $orderItems = OrderItem::all();
        return response()->json($orderItems);
    }

    public function updateOrderItems(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'prod_id' => 'sometimes|required|exists:Products,id',
            'order_item_quantity' => 'sometimes|required|integer|min:1',
            'order_item_price' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $orderItem->update($request->only(['prod_id', 'order_item_quantity', 'order_item_price']));

        return response()->json($orderItem);
    }

    public function deleteOrderItems($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return response()->json(null, 204);
    }
}

