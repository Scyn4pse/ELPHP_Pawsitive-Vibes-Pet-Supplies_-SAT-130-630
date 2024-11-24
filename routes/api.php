<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\NotificationController;

//Customer routes
Route::post('customer/register', [CustomerController::class, 'customerSignup']);
Route::post('customer/login', [CustomerController::class, 'customerLogin']);
Route::middleware('auth:sanctum')->post('/customer/logout', [CustomerController::class, 'customerLogout']);
Route::post('customer/forgot-password', [CustomerController::class, 'customerForgetPassword']);
Route::get('customer/find-customer/{id}', [CustomerController::class, 'getCustomer']);
Route::get('customer/allCustomer',[CustomerController::class, 'getAllCustomers']);
Route::patch('customer/update-customer/{id}', [CustomerController::class, 'updateCustomer']);
Route::delete('customer/delete-customer/{id}', [CustomerController::class, 'deleteCustomer']);
//Seller routes
Route::post('seller/register', [SellerController::class, 'sellerSignup']);
Route::post('seller/login', [SellerController::class, 'sellerLogin']);
Route::middleware('auth:sanctum')->post('/seller/logout', [SellerController::class, 'sellerLogout']);
Route::post('forget-password/seller', [SellerController::class, 'sellerForgetPassword']);
Route::get('seller/find-seller/{id}', [SellerController::class, 'getSeller']);
Route::get('seller/allSeller',[SellerController::class, 'getAllSellers']);
Route::patch('seller/update-seller/{id}', [SellerController::class, 'updateSeller']);
Route::delete('seller/delete-seller/{id}', [SellerController::class, 'deleteSeller']);
//Product routes
Route::post('products/store', [ProductController::class, 'createProduct']);
Route::get('products/find-product/{id}', [ProductController::class, 'getProduct']);
Route::get('products/allProducts', [ProductController::class, 'getAllProducts']);
Route::patch('products/update-product/{id}', [ProductController::class, 'updateProduct']);
Route::delete('products/delete-product/{id}', [ProductController::class, 'deleteProduct']);
//Cart routes



