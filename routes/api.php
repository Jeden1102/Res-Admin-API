<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\editProfile;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\OrdersDelivery;
use App\Http\Controllers\salesInfo;
use App\Http\Controllers\stoliksController;
use App\Http\Controllers\viewController;
use App\Http\Controllers\workController;

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
Route::get("/productsGrupped",[ProductController::class,"productsGrupped"]);
//add user
Route::post("/addProduct",[ProductController::class,"store"]);
//get one user
Route::get("/products/{id}",[ProductController::class,"show"]);
//delete one user
Route::delete("/products/{id}",[ProductController::class,"destroy"]);
//update one user
Route::put("/products/{id}",[ProductController::class,"update"]);

//CATEGOIRES
Route::resource('/categories', categoriesController::class)->except([
    'edit', 'create'
]);
//STOLIKI
Route::resource('/stoliki', stoliksController::class)->except([
    'edit', 'create'
]);
//delete all stoliki
Route::post('/deleteStoliki',[stoliksController::class,"deleteAll"]);
//views
Route::resource('/views', viewController::class)->except([
    'edit', 'create'
]);
//movies
Route::resource('/movies', MovieController::class)->except([
    'edit', 'create'
]);

//orders
Route::resource('/orders', ordersController::class)->except([
    'edit', 'create'
]);
//orders delivery

Route::resource('/ordersDelivery', OrdersDelivery::class)->except([
    'edit', 'create'
]);
//tip data
Route::get('/tipData/{id}',[ordersController::class,"getTipsData"]);
Route::get('/tipByDate/{id}',[ordersController::class,"getTipsByDate"]);
//sales info 
Route::get('/salesInfo',[salesInfo::class,"ordersInfo"]);

//work time
Route::resource('/work', workController::class)->except([
    'edit', 'create'
]);
//sum work time
Route::get('/sumWork/{id}',[workController::class,"sumHoursWorked"]);

//ACCOUNT
Route::post("/login",[accountController::class,"login"]);
//register
Route::post('/register',[accountController::class,"create"]);

//profile edit
Route::put("/profile/{id}",[editProfile::class,"update"]);
Route::put("/changePassword/{id}",[editProfile::class,"changePassword"]);


//contact form
Route::post('/contact', [ContactController::class, 'subscribe']);