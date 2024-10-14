<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-4">All Orders</h1>

    <table class="min-w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Order ID</th>
                <th class="border border-gray-300 px-4 py-2">Customer Name</th>
                <th class="border border-gray-300 px-4 py-2">Order Date</th>
                <th class="border border-gray-300 px-4 py-2">Total Amount</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $order->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $order->customer_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $order->order_date }}</td>
                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($order->total_amount, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:underline">View Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $orders->links() }} <!-- This will generate the pagination links -->
    </div>
</div>
