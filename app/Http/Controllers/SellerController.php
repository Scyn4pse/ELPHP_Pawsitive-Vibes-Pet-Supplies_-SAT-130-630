<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    // Get all sellers
    public function index()
    {
        return response()->json(Seller::all());
    }

    // Create a new seller
    public function sellerSignup(Request $request)
    {
        $request->validate([
            'seller_name' => 'required|string|max:255',
            'seller_email' => 'required|email|unique:Seller,seller_email',
            'seller_password' => 'required|string|min:6',
            'seller_phone' => 'required|string|unique:Seller,seller_phone|max:255',
            'seller_store_name' => 'required|string|max:255',
        ]);

        $seller = Seller::create([
            'seller_name' => $request->seller_name,
            'seller_email' => $request->seller_email,
            'seller_password' => Hash::make($request->seller_password),
            'seller_phone' => $request->seller_phone,
            'seller_store_name' => $request->seller_store_name,
            'user_role' => 'Seller',
        ]);

        return response()->json($seller, 201);
    }

    // Get a specific seller
    public function getSeller($id)
    {
        return response()->json(Seller::findOrFail($id));
    }
    public function getAllSellers() {
        $sellers = Seller::all();
        return response()->json($sellers);
    }

    // Update seller details
    public function updateSeller(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $seller->update($request->all());
        return response()->json($seller);
    }

    // Delete seller
    public function deleteSeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
        return response()->json(null, 204);
    }
}