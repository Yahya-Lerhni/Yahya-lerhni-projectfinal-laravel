<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Fashion',
            'Sports',
            'Home & Garden',
            'Beauty & Health',
            'Toys & Games',
            'Automotive',
            'Books',
            'Music',
            'Office Supplies',
            'Pet Supplies',
            'Jewelry',
            'Shoes',
            'Watches',
            'Grocery'
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
