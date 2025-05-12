<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'T-Shirt', 'category_image' => 'images/t-shirt.webp'],
            ['name' => 'Casual Shirt', 'category_image' => 'images/casual.avif'],
            ['name' => 'Dress Shirt', 'category_image' => 'images/dress.jpeg'],
            ['name' => 'Jean Pant', 'category_image' => 'images/jean.jpg'],
            ['name' => 'Cotton Jean Pant', 'category_image' => 'images/cotton.jpeg'],
            ['name' => 'Dress Pant', 'category_image' => 'images/dress_pant.webp'],
        ];
        DB::table('categories')->insert($categories);
    }
}
