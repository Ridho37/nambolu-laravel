<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $recentProducts  = Product::with('category')->latest()->take(3)->get();

        return view('dashboard.dashboard-page', [
            'totalProducts'     => $totalProducts,
            'totalCategories'   => $totalCategories,
            'recentProducts'    => $recentProducts,
        ]);
    }

public function showProducts()
{
    // Ambil data produk dengan relasi kategori untuk menghindari N+1 problem
    // dan urutkan dari yang terbaru, lalu paginasi
    $products = \App\Models\Product::with('category')->latest()->paginate(10);

    return view('dashboard.dashboard-products', [
        'products' => $products
    ]);
}
    
    public function showCategories()
    {
        $allCategories = Category::latest()->get();
        return view('dashboard.dashboard-categories', ['categories' => $allCategories]);
    }

    public function create()
    {
        return view('dashboard.dashboard-create');
    }
}
