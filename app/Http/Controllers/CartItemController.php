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
    public function addToCartItem(Request $request)
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
    public function getCartItem($id)
    {
        return response()->json(CartItem::findOrFail($id));
    }
    public function getAllCartItems() {
        $cartItems = CartItem::all();
        return response()->json($cartItems);
    }

    // Update cart item details
    public function updateCartItem(Request $request, $id)
    {
        // Find the cart item by ID or fail
        $cartItem = CartItem::findOrFail($id);

        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
            // Add other fields as necessary
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update the cart item with validated data
        $cartItem->update($request->only(['quantity', 'price'])); // Specify fields to update

        // Return the updated cart item with a success response
        return response()->json($cartItem, 200);
    }

    // Delete cart item
    public function deleteCartItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        return response()->json(null, 204);
    }
}

