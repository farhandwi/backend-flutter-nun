<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

//logout
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//get categories
Route::get('/categories', [\App\Http\Controllers\Api\CategoryController::class, 'index'])->middleware('auth:sanctum');

//get products
Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index'])->middleware('auth:sanctum');

//orders
Route::post('/orders', [\App\Http\Controllers\Api\OrderController::class, 'store'])->middleware('auth:sanctum');

//get all orders
Route::get('/orders', [\App\Http\Controllers\Api\OrderController::class, 'index'])->middleware('auth:sanctum');

//report
Route::get('/reports/summary', [\App\Http\Controllers\Api\ReportController::class, 'summary'])->middleware('auth:sanctum');
Route::get('/reports/product-sales', [\App\Http\Controllers\Api\ReportController::class, 'productSales'])->middleware('auth:sanctum');
