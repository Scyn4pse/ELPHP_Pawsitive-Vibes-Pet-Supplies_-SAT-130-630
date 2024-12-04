<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    // Create a new customer
    public function customerSignup(Request $request)
{
    $request->validate([
        'cust_name' => 'required|string|max:255',
        'cust_email' => 'required|email|unique:Customer,cust_email',
        'cust_password' => 'required|string|min:6',
        'cust_phone' => 'required|string|unique:Customer,cust_phone',
        'cust_address' => 'nullable|string|max:255',
        'user_role' => 'required|string|max:255'
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
// User Login
public function customerLogin(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'cust_email' => 'required|email',
        'cust_password' => 'required|string|min:6',
    ]);

    // Attempt to find user in the Customer table
    $user = Customer::where('cust_email', $request->cust_email)->first();

    // Check if the user exists in the Seller table if not found in Customer
    $isSeller = false; // Track whether the user is a seller
    if (!$user) {
        // Attempt to find the user in the Seller table
        $user = Seller::where('seller_email', $request->cust_email)->first();
        $isSeller = true;
    }

    // Validate credentials if user is found
    if ($user) {
        $passwordField = $isSeller ? 'seller_password' : 'cust_password';
        
        // Check if password matches the stored hash
        if (Hash::check($request->cust_password, $user->$passwordField)) {
            // Determine the role (Seller or Customer)
            $role = $isSeller ? 'Seller' : 'Customer';

            // Generate a role-specific token name
            $tokenName = $role . 'Token';
            $token = $user->createToken($tokenName)->plainTextToken;

            // Return response with token and user details
            return response()->json([
                'message' => "$role login successful",
                'token' => $token,
                'role' => $role,
                'seller_id' => $isSeller ? $user->seller_id : null, 
                'cust_id' => $isSeller ? null : $user->cust_id,
            ], 200);
        }
    }

    // If authentication fails, return error message
    return response()->json(['message' => 'Invalid credentials'], 401);
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
        $request->validate(['cust_email' => 'required|email',
        'new_password' => 'required|string|min:6|confirmed',
    ]);

    $customer = Customer::where('cust_email', $request->cust_email)->first();

        if ($customer) {
            $customer->cust_password = Hash::make($request->new_password);
            $customer->save();

            return response()->json(['message' => 'Password reset successful'], 200);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }
    //verify email
    public function verifyEmail(Request $request)
{
    $request->validate(['cust_email' => 'required|email']);

    $customer = Customer::where('cust_email', $request->cust_email)->first();

    if ($customer) {
        return response()->json(['message' => 'Email exists'], 200);
    } else {
        return response()->json(['error' => 'Email not found'], 404);
    }
}


    // Get a specific customer
    public function getCustomer(Request $request)
    {
        $custId = $request->input('cust_id');
        $customer = Customer::find($custId);
        return response()->json($customer, 201);
    }
    public function getAllCustomers() {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Update customer details
    public function updateCustomer(Request $request, $id)
{
    // Find the customer or fail with a 404 response
    $customer = Customer::findOrFail($id);

    // Validate the incoming request data
    $request->validate([
        'customer_email' => 'sometimes|required|email|unique:customers,customer_email,' . $customer->id,
        'customer_name' => 'sometimes|required|string|max:255',
        'customer_phone' => 'sometimes|nullable|string|max:15', // Example for phone number validation
        // Add other fields as necessary
    ]);

    // Prepare the data for update
    $data = $request->all();

    // Hash the password if it is being updated
    if (isset($data['cust_password'])) {
        $data['cust_password'] = Hash::make($data['cust_password']);
    } else {
        // Remove password from the data if not being updated
        unset($data['cust_password']);
    }

    // Update the customer's information
    $customer->update($data);

    return response()->json($customer, 200);
}
    // Delete customer
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
