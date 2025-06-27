<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <-- Import Model Product

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 produk terbaru dari database
        $products = Product::latest()->take(3)->get();

        // Kirim data products ke view 'index'
        return view('index', ['products' => $products]);
    }
}