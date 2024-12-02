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
Route::post('customer/verify-email', [CustomerController::class, 'verifyEmail']);
Route::post('customer/forgot-password', [CustomerController::class, 'customerForgetPassword']);
Route::get('customer/get-customer-by-id', [CustomerController::class, 'getCustomer']);
Route::get('customer/all-customers',[CustomerController::class, 'getAllCustomers']);
Route::patch('customer/update-customer/', [CustomerController::class, 'updateCustomer']);
Route::delete('customer/delete-customer/', [CustomerController::class, 'deleteCustomer']);
//Seller routes
Route::post('seller/register', [SellerController::class, 'sellerSignup']);
Route::post('seller/login', [SellerController::class, 'sellerLogin']);
Route::middleware('auth:sanctum')->post('/seller/logout', [SellerController::class, 'sellerLogout']);
Route::post('seller/forgot-password', [SellerController::class, 'sellerForgetPassword']);
Route::get('seller/get-seller-by-id', [SellerController::class, 'getSeller']);
Route::get('seller/all-sellers',[SellerController::class, 'getAllSellers']);
Route::patch('seller/update-seller/', [SellerController::class, 'updateSeller']);
Route::delete('seller/delete-seller/', [SellerController::class, 'deleteSeller']);
//Product routes
Route::middleware('auth:sanctum')->post('products/upload-product', [ProductController::class, 'uploadProduct']);
Route::get('products/get-product-by-id', [ProductController::class, 'getProduct']);
Route::get('products/all-products', [ProductController::class, 'getAllProducts']);
Route::patch('products/update-product/', [ProductController::class, 'updateProduct']);
Route::delete('products/delete-product/', [ProductController::class, 'deleteProduct']);
Route::get('products/seller/{seller_id}', [ProductController::class, 'getProductsBySeller']);
//Cart routes
Route::middleware('auth:sanctum')->post('cart/add-to-cart', [CartController::class, 'addToCart']);
Route::get('cart/get-cart-by-id/', [CartController::class, 'getCart']);
Route::get('cart/all-carts', [CartController::class, 'getAllCarts']);
Route::patch('cart/update-cart/', [CartController::class, 'updateCart']);
Route::delete('cart/delete-cart/', [CartController::class, 'deleteCart']);
//CartItem routes
Route::middleware('auth:sanctum')->post('cart-item/add-to-cart-item', [CartItemController::class, 'addToCartItem']);
Route::get('cart-item/get-cart-item-by-id/', [CartItemController::class, 'getCartItem']);
Route::get('cart-item/all-cart-item', [CartItemController::class, 'getAllCartItems']);
Route::patch('cart-item/update-cart-item/', [CartItemController::class, 'updateCartItem']);
Route::delete('cart-item/delete-cart-item/', [CartItemController::class, 'deleteCartItem']);
//Order routes
Route::middleware('auth:sanctum')->post('order/add-to-order', [OrderController::class, 'addToOrder']);
Route::get('order/get-order-by-id/', [OrderController::class, 'getOrder']);
Route::get('order/all-orders', [OrderController::class, 'getAllOrders']);
Route::patch('order/update-order/', [OrderController::class, 'updateOrder']);
Route::delete('order/delete-order/', [OrderController::class, 'deleteOrder']);
//OrderItem routes
Route::middleware('auth:sanctum')->post('order-item/add-to-order-item', [OrderItemController::class, 'addToOrderItem']);
Route::get('order-item/get-order-item-by-id/', [OrderItemController::class, 'getOrderItem']);
Route::get('order-item/all-order-items', [OrderItemController::class, 'getAllOrderItems']);
Route::patch('order-item/update-order-item/', [OrderItemController::class, 'updateOrderItem']);
Route::delete('order-item/delete-order-item/', [OrderItemController::class, 'deleteOrderItem']);
//Notification routes
Route::middleware('auth:sanctum')->post('notification/create-notification', [NotificationController::class, 'createNotifications']);
Route::get('notification/get-notification/', [NotificationController::class, 'getNotification']);
Route::get('notification/all-notification', [NotificationController::class, 'getAllNotifications']);
Route::patch('notification/update-notification/', [NotificationController::class, 'updateNotification']);
Route::delete('notification/delete-notification/', [NotificationController::class, 'deleteNotification']);



