<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function customerSignup(Request $request)
{
    $request->validate([
        'cust_name' => 'required|string|max:255',
        'cust_email' => 'required|email|unique:Customers,cust_email',
        'cust_password' => 'required|string|min:6',
        'cust_phone' => 'required|string|unique:Customers,cust_phone',
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
public function customerLogin(Request $request)
{
    $request->validate([
        'cust_email' => 'required|email',
        'cust_password' => 'required|string|min:6',
    ]);

    $user = Customer::where('cust_email', $request->cust_email)->first();

    $isSeller = false; 
    if (!$user) {
        $user = Seller::where('seller_email', $request->cust_email)->first();
        $isSeller = true;
    }

    if ($user) {
        $passwordField = $isSeller ? 'seller_password' : 'cust_password';
        
        if (Hash::check($request->cust_password, $user->$passwordField)) {
            
            $role = $isSeller ? 'Seller' : 'Customer';

            $tokenName = $role . 'Token';
            $token = $user->createToken($tokenName)->plainTextToken;

            return response()->json([
                'message' => "$role login successful",
                'token' => $token,
                'role' => $role,
                'seller_id' => $isSeller ? $user->seller_id : null, 
                'cust_id' => $isSeller ? null : $user->cust_id,
            ], 200);
        }
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}




    public function customerLogout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Customer logged out successfully'], 200);
    }

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

    public function updateCustomer(Request $request, $id)
{
    $customer = Customer::findOrFail($id);

    $request->validate([
        'customer_email' => 'sometimes|required|email|unique:Customers,customer_email,' . $customer->id,
        'customer_name' => 'sometimes|required|string|max:255',
        'customer_phone' => 'sometimes|nullable|string|max:15', 
    ]);

    $data = $request->all();

    if (isset($data['cust_password'])) {
        $data['cust_password'] = Hash::make($data['cust_password']);
    } else {
        unset($data['cust_password']);
    }

    $customer->update($data);

    return response()->json($customer, 200);
}
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
