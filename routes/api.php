<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderlineController;
use App\Http\Controllers\PaymentController;
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

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
});

    
//for a user
Route::post("userSignup",[UserController::class,'userRegister']);

Route::post("userSignin",[UserController::class,'login']);

Route::put("userUpdate",[UserController::class,'update']);

Route::get("Getuser",[UserController::class,'Getuser']); 

Route::delete("userDelete/{id}",[UserController::class,'delete']); 


//for products
Route::get("productRead", [ProductController::class,'productRead']);

Route::get("productReadById/{id}", [ProductController::class,'productReadById']);

Route::post("productCreate",[ProductController::class,'productCreate']);

Route::put("productUpdate",[ProductController::class,'productUpdate']);

Route::delete("productDelete/{id}",[ProductController::class,'productDelete']);

//for Order

Route::post("OrderCreate",[OrderController::class,'Create']);

Route::get("OrderRead", [OrderController::class,'Read']);

Route::get("OrderReadById/{id}",[OrderController::class,'ReadById']);

Route::put("OrderUpdate",[OrderController::class,'Update']);

Route::delete("OrderDelete/{id}",[OrderController::class,'Delete']);

// for orderline 

Route::post("OrderlineCreate",[OrderlineController::class,'Create']);

Route::get("OrderlineRead", [OrderlineController::class,'Read']);

Route::get("OrderlineReadById/{id}",[OrderlineController::class,'ReadById']);

Route::put("OrderlineUpdate",[OrderlineController::class,'Update']);

Route::delete("OrderlineDelete/{id}",[OrderlineController::class,'Delete']);


//for Payment 

Route::post("PaymentCreate",[PaymentController::class,'Create']);

Route::get("PaymentReadById/{id}",[PaymentController::class,'ReadById']);

Route::put("PaymentUpdate",[PaymentController::class,'Update']);

Route::delete("PaymentDelete/{id}",[PaymentController::class,'Delete']);