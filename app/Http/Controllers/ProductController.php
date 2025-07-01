<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Hanya mengambil semua produk dan mengirimnya ke view
        // $products = Product::latest()->get();
        $products = Product::orderBy('id', 'desc')->paginate(3);
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