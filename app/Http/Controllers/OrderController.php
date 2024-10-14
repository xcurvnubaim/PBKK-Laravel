<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    // Display list of orders
    public function index()
    {
        $orders = Order::with('orderDetails', 'staff')->get();
        return view('orders.index', compact('orders'));
    }

    // Show form to create a new order
    public function create()
    {
        return view('orders.create');
    }

    // Store a newly created order
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'details.*.item_id' => 'required|exists:items,id',
            'details.*.quantity' => 'required|numeric|min:1',
        ]);

        // Create the order and assign the logged-in user as staff
        $order = new Order([
            'customer_name' => $request->customer_name,
            'order_date' => $request->order_date,
            'total_amount' => $request->total_amount,
            'staff_id' => Auth::id(), // Assuming you're using Laravel's Auth system
        ]);
        $order->save();

        // Prepare order details data
        $details = [];
        foreach ($request->details as $detail) {
            $details[] = [
                'item_id' => $detail['item_id'],
                'quantity' => $detail['quantity'],
                'price' => Item::find($detail['item_id'])->price,
            ];
        }

        // Create the related order details
        $order->orderDetails()->createMany($details);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Display a specific order
    public function show($id)
    {
        $order = Order::with('orderDetails', 'staff')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Show form to edit an order
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    // Update the order
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'staff_id' => 'required|exists:users,id',
        ]);

        // Find and update the order
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
