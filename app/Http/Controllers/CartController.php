<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Get all carts
    public function index()
    {
        return response()->json(Cart::all());
    }

    // Create a new cart
    // public function addtoCart(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'cust_id' => 'required|exists:customers,id',
    //         'cart_item_id' => 'required|exists:cart_items,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }

    //     $cart = Cart::create($request->all());
    //     return response()->json($cart, 201);
    // }
    public function addToCart(Request $request)
{
    $validator = Validator::make($request->all(), [
        'cust_id' => 'required|exists:customer,cust_id',
        'prod_id' => 'required|exists:product,prod_id',
        'cart_item_quantity' => 'required|integer|min:1',
        'cart_item_price' => 'required|numeric|min:0',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    try {
        $cart = Cart::firstOrCreate(
            ['cust_id' => $request->cust_id],
            ['cart_created_at' => now(), 'cart_updated_at' => now()]
        );

        $cartItem = CartItem::create([
            'cart_id' => $cart->cart_id,
            'prod_id' => $request->prod_id,
            'cart_item_quantity' => $request->cart_item_quantity,
            'cart_item_price' => $request->cart_item_price,
        ]);

        // Load the related product and its seller
        $cartItem->load('product.seller');

        return response()->json([
            'message' => 'Item added to cart successfully',
            'cart_item' => $cartItem
        ], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
}


    // Get cart items for a user
    public function getCartItems(Request $request)
{
    $validator = Validator::make($request->all(), [
        'cust_id' => 'required|exists:Customer,cust_id', // Reference the correct table and column
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    try {
        $cartItems = CartItem::with('product.seller')
            ->whereHas('cart', function ($query) use ($request) {
                $query->where('cust_id', $request->cust_id);
            })
            ->get();

        return response()->json(['cart_items' => $cartItems], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
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
