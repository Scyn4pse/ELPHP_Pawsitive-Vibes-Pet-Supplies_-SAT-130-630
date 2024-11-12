<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get all products
    public function index()
    {
        return response()->json(Product::all());
    }

    // Create a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' > 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'seller_id' => 'required|exists:sellers,id',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // Get a specific product
    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    // Update product details
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}

