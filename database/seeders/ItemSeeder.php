<?php

namespace Database\Seeders;

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
        $items = [
            ['name' => 'Burger', 'price' => 50000, 'stock' => 100],
            ['name' => 'Pizza', 'price' => 80000, 'stock' => 75],
            ['name' => 'Soda', 'price' => 20000, 'stock' => 200],
            ['name' => 'Pasta', 'price' => 70000, 'stock' => 60],
            ['name' => 'Salad', 'price' => 30000, 'stock' => 150],
            ['name' => 'Coffee', 'price' => 25000, 'stock' => 80],
            ['name' => 'Tea', 'price' => 15000, 'stock' => 100],
            ['name' => 'Ice Cream', 'price' => 40000, 'stock' => 90],
            ['name' => 'Sandwich', 'price' => 35000, 'stock' => 110],
            ['name' => 'Juice', 'price' => 20000, 'stock' => 120],
            ['name' => 'Fries', 'price' => 15000, 'stock' => 130],
            ['name' => 'Chicken Wings', 'price' => 60000, 'stock' => 70],
            ['name' => 'Steak', 'price' => 120000, 'stock' => 40],
            ['name' => 'Tacos', 'price' => 45000, 'stock' => 55],
            ['name' => 'Cupcakes', 'price' => 30000, 'stock' => 65],
        ];
    
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
