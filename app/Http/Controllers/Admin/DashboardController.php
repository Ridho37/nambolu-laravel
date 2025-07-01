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
        $recentProducts  = Product::getRecentProducts(3);

        return view('dashboard.dashboard-page', [
            'totalProducts'     => $totalProducts,
            'totalCategories'   => $totalCategories,
            'recentProducts'    => $recentProducts,
        ]);
    }
}
