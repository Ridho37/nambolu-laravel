<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID dari kategori "Bolu Gulung"
        $boluCategory = Category::where('name', 'Bolu Gulung')->first();

        // Pastikan kategori ditemukan sebelum membuat produk
        if ($boluCategory) {
            Product::create([
                'name' => 'Bolu Gulung Keju',
                'slug' => Str::slug('Bolu Gulung Keju'),
                'category_id' => $boluCategory->id,
                'description' => 'Lembutnya bolu dengan isian keju premium yang melimpah.',
                'price' => 50000,
                'image' => 'bolugulung/bolukeju.jpeg' // Pastikan nama file ini benar
            ]);
            
            // Produk lainnya (pastikan nama filenya juga benar)
            Product::create([
                'name' => 'Bolu Gulung Cokelat',
                'slug' => Str::slug('Bolu Gulung Cokelat'),
                'category_id' => $boluCategory->id,
                'description' => 'Manisnya cokelat premium dalam gulungan bolu yang empuk.',
                'price' => 50000,
                'image' => 'bolugulung/bolucokelat.jpeg' // Periksa nama file ini
            ]);
            
            Product::create([
                'name' => 'Bolu Gulung Pandan',
                'slug' => Str::slug('Bolu Gulung Pandan'),
                'category_id' => $boluCategory->id,
                'description' => 'Aroma wangi pandan asli dengan isian krim yang lembut.',
                'price' => 45000,
                'image' => 'bolugulung/bolupandan.jpeg' // Periksa nama file ini
            ]);
        }
    }
}