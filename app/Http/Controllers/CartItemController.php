<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartItemController extends Controller
{
    public function index()
    {
        return response()->json(CartItem::all());
    }

    public function addToCartItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prod_id' => 'required|exists:Products,id',
            'cart_item_quantity' => 'required|integer|min:1',
            'cart_item_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $cartItem = CartItem::create($request->all());
        return response()->json($cartItem, 201);
    }

    public function getCartItem($id)
    {
        return response()->json(CartItem::findOrFail($id));
    }
    public function getAllCartItems() {
        $cartItems = CartItem::all();
        return response()->json($cartItems);
    }

    public function updateCartItem(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cartItem->update($request->only(['quantity', 'price']));

        return response()->json($cartItem, 200);
    }

    public function deleteCartItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return response()->json(null, 204);
    }
}

