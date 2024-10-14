<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-4">Order Details</h1>

    @if ($order)
        <h3 class="text-lg font-semibold mb-2">Customer Name: {{ $order->customer_name }}</h3>
        <h4 class="text-lg font-semibold mb-2">Order Date: {{ $order->order_date }}</h4>
        <h3 class="text-lg font-semibold mb-2">Staff Name: {{ $staffName }} </h3>

        <h3 class="text-lg font-semibold mb-2">Order Items</h3>
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Item</th>
                    <th class="border border-gray-300 px-4 py-2">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderdetails as $detail)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail->item->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $detail->quantity }}</td>
                        <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($detail->item->price * $detail->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-lg font-semibold mt-4">Total Amount: <span class="font-bold">Rp {{ number_format($order->total_amount, 2) }}</span></h4>
    @else
        <p class="text-red-500">Order not found.</p>
    @endif
</div>
