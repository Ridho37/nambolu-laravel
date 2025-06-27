<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController; // <-- IMPORT CONTROLLER BARU

// Rute Halaman Utama
Route::get('/', [HomeController::class, 'index']);

// RUTE BARU UNTUK HALAMAN SEMUA PRODUK
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route Halaman Detail Produk
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');


// Anda bisa menambahkan rute lain di sini nanti
// ...