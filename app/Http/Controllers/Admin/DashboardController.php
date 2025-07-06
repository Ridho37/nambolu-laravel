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
        $allProducts = Product::with('category')->latest()->get();
        return view('dashboard.dashboard-products', ['products' => $allProducts]);
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
