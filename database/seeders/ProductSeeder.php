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
                'category_id' => $boluId,
                'description' => 'Lembutnya bolu dengan isian keju premium yang melimpah.',
                'price' => 50000,
                'stock' => 15,
                'image' => 'default.jpeg.jpeg'
            ],
            [
                'name' => 'Bolu Gulung Ga Keju',
                'category_id' => $boluId,
                'description' => 'Lembutnya bolu dengan isian keju premium yang tidak melimpah.',
                'price' => 5000,
                'stock' => 1,
                'image' => 'default.jpeg',
            ],
            [
                'name' => 'Bolu Gulung tebak?',
                'category_id' => $boluId,
                'description' => 'Lembutnya bolu dengan isian keju tidak premium yang sedikit.',
                'price' => 500,
                'stock' => 156,
                'image' => 'default.jpeg',
            ],
        ];

        foreach ($products as $product){
            $product['slug'] = Str::slug($product['name'], '-');
            Product::create($product);
        }

    }
}