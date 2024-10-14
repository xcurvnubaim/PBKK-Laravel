<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination; // Add this trait for pagination

    public function render()
    {
        $orders = Order::paginate(10); // Adjust the number for items per page

        return view('livewire.orders', ['orders' => $orders]); // Pass orders to the view
    }
}
