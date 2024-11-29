<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    // Get all carts
    public function index()
    {
        return response()->json(Cart::all());
    }

    // Create a new cart
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cust_id' => 'required|exists:customers,id',
            'cart_item_id' => 'required|exists:cart_items,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $cart = Cart::create($request->all());
        return response()->json($cart, 201);
    }

    // Get a specific cart
    public function getCart($id)
    {
        $cart = Cart::findOrFail($id);
        return response()->json($cart, 200);
    }
    public function getAllCarts() {
        $carts = Cart::all();
        return response()->json($carts);
    }
    // Update cart details
    public function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'item_id' => 'sometimes|required|integer|exists:items,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            // Add other fields as necessary
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update the cart
        $cart->update($request->all());
        return response()->json($cart, 200);
    }

    // Delete cart
    public function deleteCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(null, 204);
    }
}
