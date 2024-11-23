<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'user_role' => 'Customer', // If roles are simple strings
        ]);

        return response()->json($customer, 201);
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
