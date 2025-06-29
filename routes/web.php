<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController; // product
use App\Http\Controllers\AuthController; // login
use App\Http\Controllers\Admin\DashboardController; // login
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Rute Halaman Utama
Route::get('/', [HomeController::class, 'index']);

// RUTE BARU UNTUK HALAMAN SEMUA PRODUK
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route Halaman Detail Produk
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');


// route admin
Route::get('/admin', [AuthController::class, 'login']);

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/admin/login', [AuthController::class, 'login']);

Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// hanya user tertentu yang bisa akses
Route::middleware(['auth'])->group(function() {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});



