<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Get all customers
    public function index()
    {
        return response()->json(Customer::all());
    }

    // Create a new customer
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string',
        ]);

        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }

    // Get a specific customer
    public function show($id)
    {
        return response()->json(Customer::findOrFail($id));
    }

    // Update customer details
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer);
    }

    // Delete customer
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
