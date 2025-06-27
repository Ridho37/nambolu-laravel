<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Bolu Gulung Keju',
            'description' => 'Lembutnya bolu dengan isian keju premium melimpah.',
            'price' => 50000,
            'image' => 'bolugulung/bolukeju.jpeg'
        ]);
        Product::create([
            'name' => 'Bolu Gulung Cokelat',
            'description' => 'Manisnya cokelat premium dalam gulungan bolu yang empuk.',
            'price' => 50000,
            'image' => 'bolugulung/bolucokelat.jpeg'
        ]);
        Product::create([
            'name' => 'Bolu Gulung Pandan',
            'description' => 'Aroma wangi pandan asli dengan isian krim yang lembut.',
            'price' => 45000,
            'image' => 'bolugulung/bolupandan.jpeg'
        ]);
    }
}