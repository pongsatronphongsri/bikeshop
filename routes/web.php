<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.master');
});

Route::prefix('admin')->middleware('auth','isAdmin')->group(function(){
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/edit/{id?}', [UserController::class, 'edit']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::post('/user/insert/{id?}', [UserController::class, 'insert']);
    Route::get('/user/remove/{id?}', [UserController::class, 'remove']);
    Route::get('/orderdetail',[OrderDetailController::class,'index']);
    Route::get('/orderdetail/finish/{id}', [OrderDetailController::class, 'finish_order']);
    Route::get('/orderdetail/status/{id}', [OrderDetailController::class, 'status']);
    Route::get('/orderdetail/check/{id}', [OrderDetailController::class, 'check']);
});


Route::get('/product', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/product/search', [ProductController::class,'search']);
Route::post('/product/search', [ProductController::class,'search']);
Route::get('/product/edit/{id?}', [ProductController::class, 'edit']);
Route::post('/product/update', [ProductController::class, 'update']);
Route::post('/product/insert/{id?}', [ProductController::class, 'insert']);
Route::get('/product/remove/{id?}', [ProductController::class, 'remove']);

//
Route::get('/product/category', [CategoryController::class,'index']);
Route::get('/product/category/search', [CategoryController::class,'search']);
Route::post('/product/category/search', [CategoryController::class,'search']);
Route::get('/product/category/edit/{id?}', [CategoryController::class, 'edit']);
Route::post('/product/category/update', [CategoryController::class, 'update']);
Route::post('/product/category/insert/{id?}',[CategoryController::class,'insert']);
Route::get('/product/category/remove/{id?}', [CategoryController::class, 'remove']);



Route::get('/home', [HomeController::class, 'index']);

Route::get('/cart/view', [CartController::class, 'viewCart']);
Route::get('/cart/add/{id}', [CartController::class, 'addToCart']);
Route::get('/cart/delete/{id}', [CartController::class, 'deleteCart']);
Route::get('/cart/update/{id}/{qty}', [CartController::class, 'updateCart']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/cart/checkout', [CartController::class, 'checkout']);
Route::get('/cart/complete', [CartController::class, 'complete']);
Route::get('/cart/finish', [CartController::class, 'finish_order']);





