<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Seller;

class AuthController extends Controller
{
    // Customer Signup
public function customerSignup(Request $request)
{
    $validator = Validator::make($request->all(), [
        'cust_name' => 'required|string|max:255',
        'cust_email' => 'required|email|unique:Customer,cust_email',
        'cust_password' => 'required|string|min:6',
        'cust_phone' => 'required|string|unique:Customer,cust_phone',
        'cust_address' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $customer = Customer::create([
        'cust_name' => $request->cust_name,
        'cust_email' => $request->cust_email, // Ensure email is provided
        'cust_password' => bcrypt($request->cust_password),
        'cust_phone' => $request->cust_phone,
        'cust_address' => $request->cust_address,
    ]);
    return response()->json(['message' => 'Customer registered successfully'], 201);
}

// Customer Login
public function customerLogin(Request $request)
{
    $customer = Customer::where('cust_email', $request->cust_email)->first();

    if ($customer && Hash::check($request->cust_password, $customer->cust_password)) {
        return response()->json(['message' => 'Customer login successful'], 200);
    } else {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}

// Seller Signup
public function sellerSignup(Request $request)
{
    $validator = Validator::make($request->all(), [
        'seller_name' => 'required|max:255',
        'seller_email' => 'required|email|unique:Seller,seller_email',
        'seller_password' => 'required|min:6',
        'seller_phone' => 'required|unique:Seller,seller_phone|max:255',
        'seller_store_name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $seller = Seller::create([
        'seller_name' => $request->seller_name,
        'seller_email' => $request->seller_email,
        'seller_password' => Hash::make($request->seller_password),
        'seller_phone' => $request->seller_phone,
        'seller_store_name' => $request->seller_store_name,
    ]);

    return response()->json(['message' => 'Seller registered successfully'], 201);
}

// Seller Login
public function sellerLogin(Request $request)
{
    $seller = Seller::where('seller_email', $request->seller_email)->first();

    if ($seller && Hash::check($request->seller_password, $seller->seller_password)) {
        return response()->json(['message' => 'Seller login successful'], 200);
    } else {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
}

