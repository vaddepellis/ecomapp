<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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
Route::get('/',[UserController::class,'index']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

//category
Route::post('add-category',[CategoryController::class,'addCategory']);
Route::get('get-category',[CategoryController::class,'getCategory']);

//Product
Route::post('add-product',[ProductController::class,'addProduct']);
Route::get('get-products',[ProductController::class,'getProducts']);
Route::get('get-product/{id}',[ProductController::class,'getProduct'])->whereNumber('id');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
