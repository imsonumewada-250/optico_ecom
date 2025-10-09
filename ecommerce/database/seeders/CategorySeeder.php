<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // ✅ Correct import (model ka namespace)

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing', 'slug' => 'clothing'],
            ['name' => 'Accessories', 'slug' => 'accessories'],
            ['name' => 'Home Decor', 'slug' => 'home-decor'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
