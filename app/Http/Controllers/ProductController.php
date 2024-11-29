<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        return response()->json(Product::all());
    }

    // Create a new product
    public function uploadProduct(Request $request)
{
    // Get the authenticated seller using Sanctum
    $seller = auth('api')->user();

    // Check if the seller is authenticated
    if (!$seller) {
        return response()->json(['message' => 'Only sellers can upload products'], 403);
    }

    // Log the authenticated seller's ID for debugging
    Log::info('Authenticated Seller:', ['seller_id' => $seller->seller_id]);

    // Validate the product details
    $validator = Validator::make($request->all(), [
        'prod_name' => 'required|string|max:255',
        'prod_description' => 'required|string',
        'prod_price' => 'required|numeric',
        'prod_quantity' => 'required|integer',
        'prod_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Handle the image file upload
    $imageUrl = null;
    if ($request->hasFile('prod_image')) {
        $file = $request->file('prod_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $imageUrl = 'images/' . $filename;
    }

    // Attempt to create the product
    try {
        $product = Product::create([
            'seller_id' => $seller->seller_id, // Use the authenticated seller's ID
            'prod_name' => $request->input('prod_name'),
            'prod_description' => $request->input('prod_description'),
            'prod_price' => $request->input('prod_price'),
            'prod_quantity' => $request->input('prod_quantity'),
            'prod_image' => $imageUrl,
        ]);
    } catch (\Exception $e) {
        Log::error('Product creation failed:', [
            'error' => $e->getMessage(),
            'seller_id' => $seller->seller_id,
            'input' => $request->all()
        ]);
        return response()->json(['error' => 'Product creation failed: ' . $e->getMessage()], 500);
    }

    // Return the created product as a response
    return response()->json($product, 201);
}
    public function getProduct($id){
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    public function getAllProducts() {
        $products = Product::all();
        return response()->json($products);
    }

    // Update product details
    public function updateProduct(Request $request, $id)
    {
        $seller = \App\Models\Seller::find('seller_id');

        if (!$seller){
            return response()->json(['message' => 'Only seller can update products'], 404);
        }
        else{
            $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
        }
    }

    // Delete product
    public function deleteProduct($id)
    {
        $seller = \App\Models\Seller::find('seller_id');

        if (!$seller){
            return response()->json(['message' => 'Only seller can delete products'], 404);
        }
        else{
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(null, 204);
        }
    }
}

