<?php

use Illuminate\Support\Facades\Route;
use App\Htpp\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('/orders', OrderController::class);//orders.index
// Route::resource('/products', ProductController::class);//products.index
// Route::resource('/suppliers', SupplierController::class);//supplerss.index
// Route::resource('/users', UserController::class);//users.index
// Route::resource('/companies', CompanyController::class);//companies.index
// Route::resource('/transactions', TransactionController::class);//transactions.index
Route::get('/user',[App\Http\Controllers\UserController::class,'index'])->name('users.index');
Route::post('/user',[App\Http\Controllers\UserController::class,'store'])->name('users.store');
Route::put('user/update/{id}',[App\Http\Controllers\UserController::class,'update'])->name('users.update');
Route::post('user/destroy/{id}',[App\Http\Controllers\UserController::class,'destroy'])->name('users.destroy');
Route::get('/product',[App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::post('/product',[App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
Route::put('product/update/{id}',[App\Http\Controllers\ProductController::class,'update'])->name('products.update');
Route::post('product/destroy/{id}',[App\Http\Controllers\ProductController::class,'destroy'])->name('products.destroy');
Route::get('/order',[App\Http\Controllers\OrderController::class,'index'])->name('orders.index');
Route::post('/order',[App\Http\Controllers\OrderController::class,'store'])->name('orders.store');
