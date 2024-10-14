<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory; // Import Faker

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch category IDs based on category names
        $fastFoodCategoryId = Category::where('category_name', 'Fast Food')->first()->id;
        $beveragesCategoryId = Category::where('category_name', 'Beverages')->first()->id;
        $dessertsCategoryId = Category::where('category_name', 'Desserts')->first()->id;
        $mainCourseCategoryId = Category::where('category_name', 'Main Course')->first()->id;

        // Define items with specific category IDs
        $items = [
            ['name' => 'Burger', 'price' => 50000, 'stock' => 100, 'category_id' => $fastFoodCategoryId],
            ['name' => 'Pizza', 'price' => 80000, 'stock' => 75, 'category_id' => $mainCourseCategoryId],
            ['name' => 'Soda', 'price' => 20000, 'stock' => 200, 'category_id' => $beveragesCategoryId],
            ['name' => 'Pasta', 'price' => 70000, 'stock' => 60, 'category_id' => $mainCourseCategoryId],
            ['name' => 'Salad', 'price' => 30000, 'stock' => 150, 'category_id' => $mainCourseCategoryId],
            ['name' => 'Coffee', 'price' => 25000, 'stock' => 80, 'category_id' => $beveragesCategoryId],
            ['name' => 'Tea', 'price' => 15000, 'stock' => 100, 'category_id' => $beveragesCategoryId],
            ['name' => 'Ice Cream', 'price' => 40000, 'stock' => 90, 'category_id' => $dessertsCategoryId],
            ['name' => 'Sandwich', 'price' => 35000, 'stock' => 110, 'category_id' => $fastFoodCategoryId],
            ['name' => 'Juice', 'price' => 20000, 'stock' => 120, 'category_id' => $beveragesCategoryId],
            ['name' => 'Fries', 'price' => 15000, 'stock' => 130, 'category_id' => $fastFoodCategoryId],
            ['name' => 'Chicken Wings', 'price' => 60000, 'stock' => 70, 'category_id' => $fastFoodCategoryId],
            ['name' => 'Steak', 'price' => 120000, 'stock' => 40, 'category_id' => $mainCourseCategoryId],
            ['name' => 'Tacos', 'price' => 45000, 'stock' => 55, 'category_id' => $fastFoodCategoryId],
            ['name' => 'Cupcakes', 'price' => 30000, 'stock' => 65, 'category_id' => $dessertsCategoryId],
        ];
    
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
