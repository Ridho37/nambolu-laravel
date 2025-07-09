<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController; // <-- Route Publik
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ContactMessageController; // <-- Route Admin

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute-rute untuk bagian publik (yang bisa diakses semua orang).
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Route untuk memproses form "Hubungi Kami" dari halaman depan
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Rute-rute untuk proses otentikasi (login & logout).
|
*/

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Semua rute di dalam grup ini dilindungi dan hanya bisa diakses
| oleh pengguna yang sudah login.
|
*/

Route::middleware(['auth'])->group(function() {

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Produk
    Route::get('/admin/dashboard/products', [DashboardController::class, 'showProducts'])->name('products');
    Route::get('/admin/dashboard/product/create', [ProductController::class, 'create'])->name('create');
    Route::post('/admin/dashboard/product/store', [ProductController::class, 'store'])->name('store');
    Route::get('/admin/dashboard/product/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/admin/dashboard/product/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/admin/dashboard/product/{product}', [ProductController::class, 'destroy'])->name('destroy');

    // Manajemen Kategori
    Route::get('/admin/dashboard/categories', [DashboardController::class, 'showCategories'])->name('categories');
    Route::post('/admin/dashboard/categories/store', [CategoryController::class, 'store'])->name('cstore');
    Route::delete('/admin/dashboard/categories/{category}', [CategoryController::class, 'destroy'])->name('cdestroy');
    
    // Kotak Masuk Pesan
    Route::get('/admin/dashboard/messages', [ContactMessageController::class, 'index'])->name('messages.index');

    // Pengaturan Situs
    Route::get('/admin/dashboard/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/admin/dashboard/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Profil Pengguna
    Route::get('/admin/dashboard/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/admin/dashboard/profile', [ProfileController::class, 'update'])->name('profile.update');

});