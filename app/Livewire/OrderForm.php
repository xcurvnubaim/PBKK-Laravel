<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderForm extends Component
{
    public $customer_name;
    public $order_date;
    public $details = [];
    public $total_amount = 0;
    public $successMessage = '';

    public function mount()
    {
        $this->order_date = date('Y-m-d');
        $this->details[] = ['item_id' => '', 'quantity' => 1]; // Start with one item
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'details.')) {
            $this->calculateTotalAmount();
        }
    }

    public function addItem()
    {
        $this->details[] = ['item_id' => '', 'quantity' => 1];
    }

    public function removeItem($index)
    {
        unset($this->details[$index]); // Remove the item from the details array
        $this->details = array_values($this->details); // Re-index the array
        $this->calculateTotalAmount(); // Recalculate total amount
    }

    public function calculateTotalAmount()
    {
        $this->total_amount = 0;

        foreach ($this->details as $detail) {
            if (!empty($detail['item_id']) && !empty($detail['quantity'])) {
                $item = Item::find($detail['item_id']);
                if ($item) {
                    $this->total_amount += $item->price * $detail['quantity'];
                }
            }
        }
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $this->validate([
                'customer_name' => 'required',
                'order_date' => 'required|date',
                'details.*.item_id' => 'required|exists:items,id',
                'details.*.quantity' => 'required|numeric|min:1',
            ]);

            $order = Order::create([
                'customer_name' => $this->customer_name,
                'order_date' => $this->order_date,
                'total_amount' => $this->total_amount,
                'staff_id' => Auth::user()->id,
            ]);

            $details = [];
            foreach ($this->details as $detail) {
                if (!empty($detail['item_id'])) {
                    $details[] = [
                        'order_id' => $order->id,
                        'item_id' => $detail['item_id'],
                        'quantity' => $detail['quantity'],
                        'price' => Item::find($detail['item_id'])->price,
                    ];
                }

                Item::find($detail['item_id'])->decrement('stock', $detail['quantity']);
            }

            $order->orderDetails()->createMany($details);

            // Flash success message and redirect
            session()->flash('successMessage', 'Order created successfully.');

            DB::commit();
            // Redirect to the same page to refresh
            return redirect()->route('orders.create');
        } catch (\Exception $e) {
            // Flash error message and redirect
            session()->flash('errorMessage', 'Failed to create order.');
            DB::rollBack();
            // Redirect to the same page to refresh
            return redirect()->route('orders.create');
        }
    }

    public function resetForm()
    {
        $this->customer_name = '';
        $this->order_date = '';
        $this->details = [['item_id' => '', 'quantity' => 1]];
        $this->total_amount = 0;
    }

    public function render()
    {
        $items = Item::all();
        return view('livewire.order-form', compact('items'));
    }
}
