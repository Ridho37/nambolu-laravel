<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil produk dengan ID 1, 2, dan 3 secara spesifik
        $products = Product::whereIn('id', [1, 2, 3])->get();

        // Kirim data products ke view 'index'
        return view('index', ['products' => $products]);
    }
}