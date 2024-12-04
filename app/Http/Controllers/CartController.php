<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        return response()->json(Cart::all());
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cust_id' => 'required|exists:Customers,id',
            'cart_item_id' => 'required|exists:CartItems,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $cart = Cart::create($request->all());
        return response()->json($cart, 201);
    }

    public function getCart($id)
    {
        $cart = Cart::findOrFail($id);
        return response()->json($cart, 200);
    }
    public function getAllCarts() {
        $carts = Cart::all();
        return response()->json($carts);
    }
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'item_id' => 'sometimes|required|integer|exists:items,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $cart->update($request->all());
        return response()->json($cart, 200);
    }

    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(null, 204);
    }
}
