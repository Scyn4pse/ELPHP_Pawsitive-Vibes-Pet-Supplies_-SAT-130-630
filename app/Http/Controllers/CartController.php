<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Get all carts
    public function index()
    {
        return response()->json(Cart::all());
    }

    // Create a new cart
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);

        $cart = Cart::create($request->all());
        return response()->json($cart, 201);
    }

    // Get a specific cart
    public function show($id)
    {
        return response()->json(Cart::findOrFail($id));
    }

    // Update cart details
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return response()->json($cart);
    }

    // Delete cart
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json(null, 204);
    }
}
