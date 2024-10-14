<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Fast Food'],
            ['category_name' => 'Beverages'],
            ['category_name' => 'Desserts'],
            ['category_name' => 'Main Course'],
            ['category_name' => 'Snacks'],
        ];

        foreach ($categories as $category) {
            category::create($category);
        }
    }
}
