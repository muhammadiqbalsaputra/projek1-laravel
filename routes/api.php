<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//panggil dulu controllernya
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;

Route::apiResource('/product-categories', ProductCategoryController::class)->only('index','store','show','update');
Route::apiResource('/products', ProductController::class)->only('index','store','show','update');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');