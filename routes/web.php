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
    // Route::post('tambahkeranjang/{id}', [AdminController::class, 'tambahkeranjang'])->name('tambahkeranjang');
    // Route::post('updateKeranjang', [AdminController::class, 'updateKeranjang'])->name('updateKeranjang');
    Route::post('/addToCart/{id}', [UserController::class, 'addTocart'])->name('addToCart')->middleware('web');
    Route::get('transaksi', [UserController::class, 'transaksi'])->name('transaksi');
    Route::post('transaksiProses/{id}',[UserController::class, 'transaksiProses'])->name('transaksiProses');
    // Route::get('riwayat', [AdminController::class, 'riwayat'])->name('riwayat');
});

Route::middleware('Admin')->group(function(){
    Route::get('dashboardAd', [AdminController::class, 'dashboardAd'])->name('dashboardAd');
    Route::resource('barang', AdminController::class);
    Route::get('pendataan', [AdminController::class, 'pendataan'])->name('pendataan');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//login register
Route::middleware('guest')->group(function () {
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('Authenticate', [LoginController::class, 'Authenticate'])->name('Auth');
Route::post('prosesRegister', [LoginController::class, 'prosesRegister'])->name('prosesRegister');

});