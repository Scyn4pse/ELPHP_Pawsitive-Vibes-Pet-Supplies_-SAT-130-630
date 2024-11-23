<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    // Get all cart items
    public function index()
    {
        return response()->json(CartItem::all());
    }

    // Create a new cart item
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_id' => 'required|exists:products,id',
            'cart_item_quantity' => 'required|integer|min:1',
            'cart_item_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $cartItem = CartItem::create($request->all());
        return response()->json($cartItem, 201);
    }

    // Get a specific cart item
    public function show($id)
    {
        return response()->json(CartItem::findOrFail($id));
    }

    // Update cart item details
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update($request->all());
        return response()->json($cartItem);
    }

    // Delete cart item
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return response()->json(null, 204);
    }
}

