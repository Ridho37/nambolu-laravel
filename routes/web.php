<?php

use Illuminate\Support\Facades\Route;

// Import semua controller yang akan kita gunakan
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as FrontProductController; // Frontend
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
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
// Rute untuk menampilkan & memproses login
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);

// Grup untuk semua rute admin yang memerlukan login
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute untuk logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute untuk semua fitur (CRUD) produk, kategori, dll.
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('settings', SettingController::class);
}
);