<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str; // <-- IMPORT Str

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $boluId = Category::where('slug', 'bolu')->first()->id;

        $products = [
            [
                'name' => 'Bolu Gulung Keju',
                'id_category' => $boluId,
                'description' => 'Lembutnya bolu dengan isian keju premium yang melimpah.',
                'price' => 50000,
                'stock' => 15,
                'image' => 'bolugulung/bolukeju.jpeg',
            ],
            [
                'name' => 'Bolu Gulung Ga Keju',
                'id_category' => $boluId,
                'description' => 'Lembutnya bolu dengan isian keju premium yang tidak melimpah.',
                'price' => 5000,
                'stock' => 1,
                'image' => 'bolugulung/bolukeju.jpeg',
            ],
            [
                'name' => 'Bolu Gulung tebak?',
                'id_category' => $boluId,
                'description' => 'Lembutnya bolu dengan isian keju tidak premium yang sedikit.',
                'price' => 500,
                'stock' => 156,
                'image' => 'bolugulung/bolukeju.jpeg',
            ],
        ];

        foreach ($products as $product){
            $product['slug'] = Str::slug($product['name'], '-');
            Product::create($product);
        }

    }
}