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

//Role routes
Route::get('/roles', [AuthController::class, 'handleRoleSelection']);

//Customer routes
Route::post('register/customer', [CustomerController::class, 'customerSignup']);
Route::post('login/customer', [AuthController::class, 'customerLogin']);
Route::post('customer/logout', [AuthController::class, 'customerLogout']);
Route::post('forget-password/customer', [AuthController::class, 'customerForgetPassword']);
Route::get('customer/find-customer/{id}', [CustomerController::class, 'getCustomer']);
Route::get('customer/allCustomer',[CustomerController::class, 'getAllCustomers']);
Route::patch('customer/update-customer/{id}', [CustomerController::class, 'updateCustomer']);
Route::delete('customer/delete-customer/{id}', [CustomerController::class, 'deleteCustomer']);
//Seller routes
Route::post('register/seller', [SellerController::class, 'sellerSignup']);
Route::post('login/seller', [AuthController::class, 'sellerLogin']);
Route::post('seller/logout', [AuthController::class, 'sellerLogout']);
Route::post('forget-password/seller', [AuthController::class, 'sellerForgetPassword']);
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



