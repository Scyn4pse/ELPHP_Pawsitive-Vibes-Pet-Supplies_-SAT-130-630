<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    // Get all sellers
    public function index()
    {
        return response()->json(Seller::all());
    }

    // Create a new seller
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:sellers,email',
        ]);

        $seller = Seller::create($request->all());
        return response()->json($seller, 201);
    }

    // Get a specific seller
    public function show($id)
    {
        return response()->json(Seller::findOrFail($id));
    }

    // Update seller details
    public function update(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);
        $seller->update($request->all());
        return response()->json($seller);
    }

    // Delete seller
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();
        return response()->json(null, 204);
    }
}