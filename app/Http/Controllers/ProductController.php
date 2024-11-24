<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SellerController;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        return response()->json(Product::all());
    }

    // Create a new product
    public function createProduct(Request $request)
{
    // Assume the `seller_id` is passed as part of the request or obtained from authentication
    $sellerId = $request->user()->id; // Use this if authenticated sellers create products

    // Check if the seller exists
    $seller = \App\Models\Seller::find($sellerId);

    if (!$seller) {
        return response()->json(['message' => 'Only sellers can upload products'], 403); // 403 Forbidden for unauthorized access
    }

    // Validate the product details
    $validator = Validator::make($request->all(), [
        'prod_name' => 'required|string|max:255',
        'prod_description' => 'required|string',
        'prod_price' => 'required|numeric',
        'prod_quantity' => 'required|integer',
        'prod_image' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Create the product and associate it with the seller
    $product = \App\Models\Product::create([
        'seller_id' => $seller->id, // Associate the product with the seller
        'prod_name' => $request->input('prod_name'),
        'prod_description' => $request->input('prod_description'),
        'prod_price' => $request->input('prod_price'),
        'prod_quantity' => $request->input('prod_quantity'),
        'prod_image' => $request->input('prod_image'),
    ]);

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

