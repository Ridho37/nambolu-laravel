<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <-- PASTIKAN MODEL PRODUCT DI-IMPORT

class HomeController extends Controller
{
   /**
     * Menampilkan halaman Beranda (Homepage).
     */
    public function index()
    {
        // Ambil 3 produk terbaru dari database
        $newestProducts = Product::latest()->take(3)->get();

        // Kirim data produk ke view 'index' dengan variabel 'newestProducts'
        return view('index', [
            'newestProducts' => $newestProducts
        ]);
    }
}