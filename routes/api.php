<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\ProductController;
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

//USERS
//users list
Route::get("/users",[userController::class,"index"]);
//add user
Route::post("/addUser",[userController::class,"store"]);
//get one user
Route::get("/users/{id}",[userController::class,"show"]);
//delete one user
Route::delete("/users/{id}",[userController::class,"destroy"]);
//update one user
Route::put("/users/{id}",[userController::class,"update"]);

//PRODUCTS
Route::get("/products",[ProductController::class,"index"]);
//add user
Route::post("/addProduct",[ProductController::class,"store"]);
//get one user
Route::get("/products/{id}",[ProductController::class,"show"]);
//delete one user
Route::delete("/products/{id}",[ProductController::class,"destroy"]);
//update one user
Route::put("/products/{id}",[ProductController::class,"update"]);


//ACCOUNT
Route::post("/login",[accountController::class,"login"]);
//register
Route::post('/register',[accountController::class,"create"]);
