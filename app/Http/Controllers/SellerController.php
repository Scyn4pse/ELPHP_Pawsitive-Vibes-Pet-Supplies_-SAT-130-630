<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function sellerSignup(Request $request)
    {
        $request->validate([
            'seller_name' => 'required|string|max:255',
            'seller_email' => 'required|email|unique:Sellers,seller_email',
            'seller_password' => 'required|string|min:6',
            'seller_phone' => 'required|string|unique:Sellers,seller_phone|max:255',
            'seller_address' => 'nullable|string|max:255',
            'user_role' => 'required|string|max:255',
        ]);

        $seller = Seller::create([
            'seller_name' => $request->seller_name,
            'seller_email' => $request->seller_email,
            'seller_password' => Hash::make($request->seller_password),
            'seller_phone' => $request->seller_phone,
            'seller_address' => $request->seller_address,
            'user_role' => 'Seller',
        ]);

        return response()->json($seller, 201);
    }
    public function sellerLogin(Request $request)
{
    $request->validate([
        'seller_email' => 'required|email',
        'seller_password' => 'required|string|min:6'
    ]);

    $seller = Seller::where('seller_email', $request->seller_email)->first();

    if ($seller && Hash::check($request->seller_password, $seller->seller_password)) {
        
        $sellerToken = $seller->createToken('SellerToken')->plainTextToken;

        return response()->json([
            'message' => 'Seller login successful',
            'token' => $sellerToken,
        ], 200);
    } 
    return response()->json(['error' => 'Invalid credentials'], 401);
}

    public function sellerLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Seller logged out successfully'], 200);
    }

    public function sellerForgetPassword(Request $request)
{
    
    $request->validate([
        'seller_email' => 'required|email',
        'new_password' => 'required|string|min:6|confirmed', 
    ]);

    $seller = Seller::where('seller_email', $request->seller_email)->first();

    if ($seller) {
        $seller->seller_password = Hash::make($request->new_password);
        $seller->save();

        return response()->json(['message' => 'Password reset successful'], 200);
    } else {
        return response()->json(['error' => 'Seller not found'], 404);
    }
}

    public function getSeller(Request $request)
    {
        $sellerId = $request->input('seller_id');
    
        $seller = Seller::findOrFail($sellerId);
    
        return response()->json($seller, 201);
    }
    
    public function getAllSellers() {
        $sellers = Seller::all();
        return response()->json($sellers);
    }

    public function updateSeller(Request $request, $id)
{
    $seller = Seller::findOrFail ($id);

    $request->validate([
        'seller_email' => 'sometimes|required|email|unique:Sellers,seller_email,' . $seller->id,
        'seller_name' => 'sometimes|required|string|max:255',
        'seller_password' => 'sometimes|nullable|string|min:6|confirmed', // Ensure password confirmation if provided
    ]);

    $data = $request->all();
    if (isset($data['seller_password'])) {
        $data['seller_password'] = Hash::make($data['seller_password']);
    } else {
        unset($data['seller_password']);
    }

    $seller->update($data);

    return response()->json($seller, 200);
}

    public function deleteSeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
        return response()->json(null, 204);
    }
}