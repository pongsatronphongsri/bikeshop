<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductControllerApi;
use App\Http\Controllers\Api\CategoryControllerApi;
use App\Http\Controllers\Api\UsersControllerApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product', [ProductControllerApi::class, 'product_list']);
Route::get('/category', [CategoryControllerApi::class, 'category_list']);
Route::get('/user', [UsersControllerApi::class, 'user_list']);

Route::get('/product/{category_id}', [ProductControllerApi::class, 'product_list']);
Route::post('/product/search', [ProductControllerApi::class, 'product_search']);
