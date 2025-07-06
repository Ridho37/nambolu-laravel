<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController; // product
use App\Http\Controllers\CategoryController; // product
use App\Http\Controllers\AuthController; // login
use App\Http\Controllers\Admin\DashboardController; // login
use App\Models\Category;
use Dflydev\DotAccessData\Data;
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

    // admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard/products', [DashboardController::class, 'showProducts'])->name('products');
    Route::get('/admin/dashboard/categories', [DashboardController::class, 'showCategories'])->name('categories');

    // add product
    Route::get('/admin/dashboard/product/create', [ProductController::class, 'create'])->name('create');
    Route::post('/admin/dashboard/product/store', [ProductController::class, 'store'])->name('store');

    // update product
    Route::get('/admin/dashboard/product/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/admin/dashboard/product/{product}', [ProductController::class, 'update'])->name('update');

    // delete product
    Route::delete('/admin/dashboard/product/{product}', [ProductController::class, 'destroy'])->name('destroy');

    // category
    Route::post('/admin/dashboard/categories/store', [CategoryController::class, 'store'])->name('cstore');
    Route::delete('/admin/dashboard/categories/{category}', [CategoryController::class, 'destroy'])->name('cdestroy');
});
