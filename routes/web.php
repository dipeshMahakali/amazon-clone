<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {

//     return view('product.index');
// });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/login/user', [LoginController::class, 'login'])->name('authenticate');


// Route::get('/register', [LoginController::class, 'create']);
// Route::post('/register/user', [LoginController::class, 'register'])->name('register');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index']);
    Route::get('/admin-dashboard/list', [AdminController::class, 'show']);
    Route::get('/admin-dashboard/edit/{id}', [AdminController::class, 'edit']);
    Route::post('/admin-dashboard/store', [AdminController::class, 'store'])->name('storeProduct');
    Route::post('/admin-dashboard/update/{id}', [AdminController::class, 'update'])->name('updateProduct');
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category/store', [CategoryController::class, 'store'])->name('storeCategory');
    Route::get('/location', [LocationController::class, 'index']);
    Route::post('/location/store', [LocationController::class, 'store'])->name('storeLocation');
});

// Dashboard Routes
Route::get('/', [ProductController::class, 'index']);
Route::get('/location-price-increase', [LocationController::class, 'create']);
Route::post('/set-location', [LocationController::class, 'setLocation'])->name('set.location');

Route::get('/products', [ProductController::class, 'getProducts'])->name('products');
Route::get('/search-products', [ProductController::class, 'search'])->name('product.search');
Route::get('/products/{id}', [ProductController::class, 'create']);
// Cart Routes
Route::post('/addcart', [CartController::class, 'store'])->name('cart.store');
Route::get('/showcart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/increase/{id}', [CartController::class, 'increase']);
Route::post('/cart/decrease/{id}', [CartController::class, 'decrease']);
Route::post('/cart/remove', [CartController::class, 'remove']);
