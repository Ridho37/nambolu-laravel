<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\AdminLog;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total produk, kategori, stok menipis
        $totalProducts     = Product::count();
        $totalCategories   = Category::count();
        $lowStockCount     = Product::where('stock', '<', 5)->count();

        // Produk terbaru (limit 5)
        $recentProducts    = Product::with('category')->latest()->take(5)->get();

        // Aktivitas admin terbaru (limit 5)
        $recentActivities  = AdminLog::latest()->take(5)->get();

        return view('dashboard.dashboard-page', [
            'totalProducts'     => $totalProducts,
            'totalCategories'   => $totalCategories,
            'lowStockCount'     => $lowStockCount,
            'recentProducts'    => $recentProducts,
            'recentActivities'  => $recentActivities,
        ]);
    }

    public function activity()
    {
        $logs = \App\Models\AdminLog::latest()->paginate(10);

        return view('dashboard.dashboard-activity', [
            'logs' => $logs
        ]);
    }


    public function showProducts()
    {
        $products = Product::with('category')->latest()->paginate(10);

        return view('dashboard.dashboard-products', [
            'products' => $products
        ]);
    }

    public function showCategories()
    {
        $allCategories = Category::latest()->get();

        return view('dashboard.dashboard-categories', [
            'categories' => $allCategories
        ]);
    }

    public function create()
    {
        return view('dashboard.dashboard-create');
    }
}
