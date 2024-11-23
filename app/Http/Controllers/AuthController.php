<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Seller;

class AuthController extends Controller
{
    // Handle role selection (could be handled on the Android side)
    public function handleRoleSelection(Request $request)
    {
        $role = $request->input('role');
        if ($role == 'customer') {
            return redirect()->route('customer.customerSignup');
        } elseif ($role == 'seller') {
            return redirect()->route('seller.sellerSignup');
        } else {
            return response()->json(['error' => 'Invalid role selected'], 400);
        }
    }

    // Customer Login
    public function customerLogin(Request $request)
    {
        $request->validate([
            'cust_email' => 'required|email',
            'cust_password' => 'required|string|min:6'
        ]);

        $customer = Customer::where('cust_email', $request->cust_email)->first();

        if ($customer && Hash::check($request->cust_password, $customer->cust_password)) {
            return response()->json(['message' => 'Customer login successful'], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    // Customer Logout
    public function customerLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Customer logged out successfully'], 200);
    }

    // Customer Forgot Password
    public function customerForgetPassword(Request $request)
    {
        $request->validate(['cust_email' => 'required|email']);

        $customer = Customer::where('cust_email', $request->cust_email)->first();

        if ($customer) {
            $newPassword = 'new_password'; // Generate a new password (you can make this random)
            $customer->cust_password = Hash::make($newPassword);
            $customer->save();

            return response()->json(['message' => 'Password reset successful'], 200);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    // Seller Login
    public function sellerLogin(Request $request)
    {
        $request->validate([
            'seller_email' => 'required|email',
            'seller_password' => 'required|string|min:6'
        ]);

        $seller = Seller::where('seller_email', $request->seller_email)->first();

        if ($seller && Hash::check($request->seller_password, $seller->seller_password)) {
            return response()->json(['message' => 'Seller login successful'], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    // Seller Logout
    public function sellerLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Seller logged out successfully'], 200);
    }

    // Seller Forgot Password
    public function sellerForgetPassword(Request $request)
    {
        $request->validate(['seller_email' => 'required|email']);

        $seller = Seller::where('seller_email', $request->seller_email)->first();

        if ($seller) {
            $newPassword = 'new_password'; // Generate a new password
            $seller->seller_password = Hash::make($newPassword);
            $seller->save();

            return response()->json(['message' => 'Password reset successful'], 200);
        } else {
            return response()->json(['error' => 'Seller not found'], 404);
        }
    }
}


