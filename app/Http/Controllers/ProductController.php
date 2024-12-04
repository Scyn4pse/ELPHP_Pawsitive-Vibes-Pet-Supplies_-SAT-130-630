<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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
    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    public function getAllProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Update product details

    public function updateProduct(Request $request, $id)
{
    $id = (int) $id; 

    $user = $request->user();
    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = $request->user();
    $sellerId = $user->seller_id;
    
    $product = Product::where('prod_id', $id)
                      ->where('seller_id', $sellerId)  
                      ->first();

    if (!$product) {
        return response()->json(['message' => 'Product not found or unauthorized'], 404);
    }

    try {
        $product->prod_name = $request->input('name');
        $product->prod_description = $request->input('description');
        $product->prod_price = $request->input('price');
        $product->prod_quantity = $request->input('quantity');
        Log::info('Attempting to save product', ['product' => $product]);
        $product->save();
        Log::info('Product saved successfully', ['product' => $product]);
    } catch (\Exception $e) {
        Log::error('Error updating product', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Failed to update product'], 500);
    }
    
    return response()->json($product, 200);
}



    // Delete product

    public function deleteProduct($id)
    {
        $id = (int) $id; 
        // Log the incoming request and the product ID
        Log::debug('Delete product request received', ['product_id' => $id]);
    
        // Retrieve the currently authenticated user
        $user = Auth::user();
        Log::debug('Auth status', ['auth_status' => Auth::check(), 'user' => Auth::user()]);

        if (!$user) {
            Log::warning('No authenticated user found for product deletion', ['product_id' => $id]);
            return response()->json(['message' => 'Only sellers can delete products'], 403);
        }
    
        Log::debug('Authenticated user found', ['user_id' => $user->seller_id, 'user_role' => $user->user_role]);
    
        // Check if the user is a seller
        if ($user->user_role !== 'Seller') {
            Log::warning('Unauthorized user attempted to delete product', ['user_id' => $user->seller_id, 'product_id' => $id]);
            return response()->json(['message' => 'Only sellers can delete products'], 403);
        }
    
        // Find the product
        $product = Product::findOrFail($id);
    
        Log::debug('Product found for deletion', ['product_id' => $product->id, 'seller_id' => $product->seller_id]);
    
        // Check if the product belongs to the authenticated seller
        if ($product->seller_id !== $user->seller_id) {
            Log::warning('Seller attempted to delete a product they do not own', ['user_id' => $user->seller_id, 'product_id' => $id]);
            return response()->json(['message' => 'You can only delete your own products'], 403);
        }
    
        // Delete the product
        $product->delete();
    
        Log::info('Product deleted successfully', ['product_id' => $id]);
    
        return response()->json(null, 204);
    }

    

    // Get all products by a specific seller
    public function getProductsBySeller($seller_id)
    {
        // Find products associated with the given seller_id
        $products = Product::where('seller_id', $seller_id)->get();

        // Check if the seller has any products
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for this seller'], 404);
        }

        // Return the products as a response
        return response()->json($products, 200);
    }
}
