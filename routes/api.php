<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('customer/signup', [AuthController::class, 'customerSignup']);
Route::post('customer/login', [AuthController::class, 'customerLogin']);

Route::post('seller/signup', [AuthController::class, 'sellerSignup']);
Route::post('seller/login', [AuthController::class, 'sellerLogin']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
