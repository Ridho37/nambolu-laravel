<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan kita gunakan
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as FrontProductController; // Frontend
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController; // <-- Controller untuk Admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Rute Halaman Depan (Untuk Pengunjung)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [FrontProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [FrontProductController::class, 'show'])->name('products.show');


/*
|--------------------------------------------------------------------------
| Rute Otentikasi & Admin
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);

// Grup untuk semua rute admin yang memerlukan login
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // PERBAIKAN DI SINI: Pastikan menunjuk ke ProductController dari namespace Admin
    Route::resource('products', ProductController::class);
    
    Route::resource('categories', CategoryController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('settings', SettingController::class);
});