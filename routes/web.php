<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('User')->group(function(){
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/addToCart/{id}', [UserController::class, 'addTocart'])->name('addToCart')->middleware('web');
    Route::delete('deleteCart/{id}', [UserController::class, 'deleteCart'])->name('deleteCart');
    Route::post('order', [UserController::class, 'order'])->name('order');
    Route::get('/cetak-invoice/{no_order}', [UserController::class, 'cetakInvoice'])->name('cetakInvoice');
    Route::get('invoice/{no_order}', [UserController::class, 'invoice'])->name('invoice');
    Route::post('/clear-cart', [UserController::class, 'clearCart'])->name('clearCart');


});

Route::middleware('Admin')->group(function(){
    Route::get('dashboardAd', [AdminController::class, 'dashboardAd'])->name('dashboardAd');
    Route::resource('barang', AdminController::class);
    Route::get('pendataan', [AdminController::class, 'pendataan'])->name('pendataan');
    // Route::post('terima/{id}', [AdminController::class, 'terima'])->name('terima');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//login register
Route::middleware('guest')->group(function () {
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('Authenticate', [LoginController::class, 'Authenticate'])->name('Auth');
Route::post('prosesRegister', [LoginController::class, 'prosesRegister'])->name('prosesRegister');

});
