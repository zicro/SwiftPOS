<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\Client\OrderController;
use App\Http\Controllers\Dashboard\OrderController as OrdersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            //Route::get('/', 'WelcomeController@index')->name('welcome');
			Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


            //category routes
            //Route::resource('categories', 'CategoryController')->except(['show']);
			Route::resource('categories', CategoryController::class);

            //product routes
            //Route::resource('products', 'ProductController')->except(['show']);
			Route::resource('products', ProductController::class);

            //client routes
            //Route::resource('clients', 'ClientController')->except(['show']);
			Route::resource('clients', ClientController::class);
            //Route::resource('clients.orders', 'Client\OrderController')->except(['show']);
			Route::resource('clients.orders', Client\OrderController::class);

            //order routes
            //Route::resource('orders', 'OrderController');
			Route::resource('orders', OrderController::class);
            //Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');
			Route::get('/orders/{order}/products', [OrderController::class, 'products'])->name('orders.products');


            //user routes
            //Route::resource('users', 'UserController')->except(['show']);
			Route::resource('users', UserController::class);


        });//end of dashboard routes



require __DIR__.'/auth.php';
