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

    public function show(Product $product)
    {
        // Karena kita menggunakan Route Model Binding, Laravel sudah otomatis
        // mengambil data produk dan menyimpannya di variabel $product.
        // Kita tidak perlu menulis query database lagi di sini. Ajaib, bukan?

        // Kirim data produk tunggal tersebut ke view 'products.show'
        return view('products.show', ['product' => $product]);
    }
}