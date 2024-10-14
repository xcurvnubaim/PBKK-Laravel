<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create(); // Create a Faker instance

        foreach (range(1, 5) as $index) { // Create 20 orders
            Order::create([
                'customer_name' => $faker->name, // Generate a random customer name
                'order_date' => $faker->date(), // Generate a random date
                'staff_id' => 2, // Randomly assign a staff member
                'total_amount' => 0, // Initialize total amount to 0
            ]);
        }

        // Get all orders and items
        $orders = Order::all();
        $items = Item::all();

        foreach ($orders as $order) {
            foreach (range(1, rand(1, 5)) as $index) { // Create between 1 to 5 order details per order
                $item_id = $items->random()->id; // Randomly select an item
                OrderDetail::create([
                    'order_id' => $order->id, // Link order detail to the order
                    'item_id' => $item_id, // Randomly select an item
                    'quantity' => $faker->numberBetween(1, 5), // Random quantity between 1 and 5
                    'price' => Item::find($item_id)->price, // Get the price of the item
                ]);
            }
        }

        // Update the total amount for each order
        foreach ($orders as $order) {
            $order->update(['total_amount' => $order->orderDetails->sum(fn ($detail) => $detail->price * $detail->quantity)]);
        }
    }
}
