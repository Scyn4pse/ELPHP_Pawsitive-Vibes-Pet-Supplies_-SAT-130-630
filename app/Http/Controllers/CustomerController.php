<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Get all customers
    public function index()
    {
        return response()->json(Customer::all());
    }

    // Create a new customer
    public function customerSignup(Request $request)
{
    $request->validate([
        'cust_name' => 'required|string|max:255',
        'cust_email' => 'required|email|unique:Customer,cust_email',
        'cust_password' => 'required|string|min:6',
        'cust_phone' => 'required|string|unique:Customer,cust_phone',
        'cust_address' => 'nullable|string|max:255',
    ]);

    $customer = Customer::create([
        'cust_name' => $request->cust_name,
        'cust_email' => $request->cust_email,
        'cust_password' => bcrypt($request->cust_password),
        'cust_phone' => $request->cust_phone,
        'cust_address' => $request->cust_address,
        'user_role' => $request->user_role,
    ]);

    return response()->json([
        'message' => 'Customer created successfully',
        $customer
    ], 201);
}
// Customer Login
public function customerLogin(Request $request)
{
    // Validate the request inputs
    $request->validate([
        'cust_email' => 'required|email',
        'cust_password' => 'required|string|min:6',
    ]);

    // Find the customer by email
    $customer = Customer::where('cust_email', $request->cust_email)->first();

    // Check if customer exists and password is correct
    if ($customer && Hash::check($request->cust_password, $customer->cust_password)) {
        
        // Check if the customer has a valid ID (cust_id)
        if ($customer->cust_id) {
            // Generate a personal access token
            $customerToken = $customer->createToken('CustomerToken')->plainTextToken;

            return response()->json([
                'message' => 'Customer login successful',
                'token' => $customerToken,
            ], 200);
        } else {
            return response()->json(['error' => 'Customer not found or invalid ID'], 404);
        }
    }

    return response()->json(['error' => 'Invalid credentials'], 401);
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

    // Get a specific customer
    public function getCustomer($id)
    {
        return response()->json(Customer::findOrFail($id));
    }
    public function getAllCustomers() {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Update customer details
    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer);
    }

    // Delete customer
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
