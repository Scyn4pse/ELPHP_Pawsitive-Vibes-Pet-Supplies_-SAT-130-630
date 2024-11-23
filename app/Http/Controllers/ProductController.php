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
        $seller = \App\Models\Seller::find('seller_id');

        if (!$seller){
            return response()->json(['message' => 'Only seller can upload products'], 404);
        }
        else{
            $validator = Validator::make($request->all(), [
                'prod_name' => 'required|string|max:255',
                'prod_description' => 'required|string',
                'prod_price' => 'required|numeric',
                'prod_quantity' => 'required|integer',
                'prod_image' => 'required|string',
                'prod_seller_id' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $product = Product::create($request->all());
            return response()->json($product, 201);
        }
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

