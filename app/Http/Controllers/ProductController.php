<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua produk, diurutkan dari yang PALING LAMA
        $products = Product::oldest()->get();

        // Kirim data ke view 'products.index'
        return view('products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        return view('dashboard.dashboard-create');
    }

    public function store()
    {

    }

}