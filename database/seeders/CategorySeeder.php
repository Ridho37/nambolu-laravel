<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Bolu',
            'Kue',
            'Pudding',
        ];

        foreach ($categories as $category){
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category, '-'),
            ]);
        }
    }
}
