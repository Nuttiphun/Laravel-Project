<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;

use Illuminate\Support\Facades\Auth;

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
    return view('index');
});

Route::get('/logout', [HomeController::class, 'logout']);


Route::prefix('/home')->group(function() {

    Route::get('/', [HomeController::class, 'index']);

});





Route::prefix('/order')->group(function() {

    Route::get('/', [OrderController::class, 'index']);
    
    Route::prefix('/detail')->group(function() {
        Route::get('/{id}', [OrderController::class, 'detail']);
        Route::get('/changeStatusOrder/{id}/{status}', [OrderController::class, 'changeStatusOrder']);
    });
    
    Route::get('/receipt/{id}', [OrderController::class, 'receipt']);

});



Route::prefix('/customer')->group(function() {

    Route::get('/', [CustomerController::class, 'index']);
    // Route::get('/add', [CustomerController::class, '?']);
    Route::get('/action/{id}', [CustomerController::class, 'onAction']);
    Route::post('/update', [CustomerController::class, 'onUpdate']);
    Route::get('/delete/{id}', [CustomerController::class, 'onDelete']);

});


Route::prefix('/product')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/action', [ProductController::class, 'onAction']);
    Route::get('/action/{id?}', [ProductController::class, 'onAction']);
    
    Route::post('/insert/', [ProductController::class, 'onInsert']);
    Route::post('/update/', [ProductController::class, 'onUpdate']);
    Route::get('/delete/{id}', [ProductController::class, 'onDelete']);
    
    // futures
    Route::post('/search', [ProductController::class, 'onSearch']);

    Route::prefix('/category')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        
        Route::get('/add', [CategoryController::class, 'getFormAdd']);
        Route::post('/add', [CategoryController::class, 'onAdd']);
        
        Route::get('/edit/{id?}', [CategoryController::class, 'getFormEdit']);
        Route::post('/edit/{id?}', [CategoryController::class, 'onEdit']);
    
        Route::get('/del/{id?}', [CategoryController::class, 'onDelete']);
    
        // futures
        Route::post('/search', [CategoryController::class, 'onSearch']);
    });

});


Route::prefix('/cart')->group(function () {
    
    Route::get('/view', [CartController::class, 'viewCart']);
    // Route::get('/add/{id}', [CartController::class, 'addToCart']);
    // Route::get('/update/{id}/{qty}', [CartController::class, 'updateCart']);
    // Route::get('/delete/{id}', [CartController::class, 'deleteCart']);
    
    Route::get('/checkout', [CartController::class, 'checkOut']);
    Route::post('/complete', [CartController::class, 'complete']);
    Route::post('/finish', [CartController::class, 'finish']);
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();


// Route::get('/changeStatus',[App\Http\Controllers\OrderController::class, 'changeMemberStatus'])->name('changeStatus');