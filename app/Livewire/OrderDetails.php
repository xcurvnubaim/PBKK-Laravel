<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderDetails extends Component
{
    public $orderId;
    public $order;
    public $staffName;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->order = Order::with('orderdetails.item')->find($orderId); // Load order with its details and items
        $this->staffName = $this->order?->staff->name; // Get the staff name
    }

    public function render()
    {
        return view('livewire.order-details');
    }
}
