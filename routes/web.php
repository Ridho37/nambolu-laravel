<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    $products = [
        [
            'id' => 1,
            'name' => 'Bolu Gulung Keju',
            'description' => 'Lembutnya bolu dengan isian keju premium yang melimpah',
            'price' => 50000,
            'image' => 'bolugulung/bolukeju.jpeg'
        ],
        [
            'id' => 2,
            'name' => 'Bolu Gulung Cokelat',
            'description' => 'Manisnya cokelat premium dalam gulungan bolu yang empuk.',
            'price' => 50000,
            'image' => 'bolugulung/bolucokelat.jpeg'
        ],
        [
            'id' => 3,
            'name' => 'Bolu Gulung Pandan',
            'description' => 'Aroma wangi pandan asli dengan isian krim yang lembut.',
            'price' => 45000,
            'image' => 'bolugulung/bolupandan.jpeg'
        ]
    ];

    return view('index', ['products' => $products]);
});

Route::post('/contact', function() {
    return 'Pesan terkirim (logika backend akan dibuat nanti)';
})->name('contact.send');

// Contoh rute untuk halaman semua produk
Route::get('/products', function() {
    return 'Ini adalah halaman untuk semua produk';
});

// Contoh rute untuk detail produk
Route::get('/products/{slug}', function($slug) {
    return 'Ini adalah halaman detail untuk produk: ' . $slug;
});