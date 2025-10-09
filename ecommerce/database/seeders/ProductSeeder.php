<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the Electronics category
        $electronics = Category::where('slug', 'electronics')->first();

        // ✅ Check to avoid error if category not found
        if ($electronics) {
            Product::create([
                'name' => 'Wireless Headphones',
                'description' => 'High-quality sound with deep bass and long battery life.',
                'price' => 1999.00,
                'stock' => 20,
                'image' => 'placeholder.jpg', // change when you add real images
                'category_id' => $electronics->id,
            ]);

            Product::create([
                'name' => 'Smart Watch',
                'description' => 'Fitness tracker with notifications and heart rate monitor.',
                'price' => 2999.00,
                'stock' => 15,
                'image' => 'placeholder.jpg',
                'category_id' => $electronics->id,
            ]);
        }
    }
}
