<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str; // <-- IMPORT Str

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Bolu Gulung Keju',
            'slug' => Str::slug('Bolu Gulung Keju'), // Membuat slug
            'description' => 'Lembutnya bolu dengan isian keju premium yang melimpah.',
            'price' => 50000,
            'image' => 'bolugulung/bolukeju.jpeg'
        ]);
        Product::create([
            'name' => 'Bolu Gulung Cokelat',
            'slug' => Str::slug('Bolu Gulung Cokelat'), // Membuat slug
            'description' => 'Manisnya cokelat premium dalam gulungan bolu yang empuk.',
            'price' => 50000,
            'image' => 'bolugulung/bolucokelat.jpeg'
        ]);
        Product::create([
            'name' => 'Bolu Gulung Pandan',
            'slug' => Str::slug('Bolu Gulung Pandan'), // Membuat slug
            'description' => 'Aroma wangi pandan asli dengan isian krim yang lembut.',
            'price' => 45000,
            'image' => 'bolugulung/bolupandan.jpeg'
        ]);
    }
}