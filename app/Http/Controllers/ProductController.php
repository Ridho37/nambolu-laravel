<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Hanya mengambil semua produk dan mengirimnya ke view
        $products = Product::latest()->get();

        return view('products.index', ['products' => $products]);
    }
}