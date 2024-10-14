<div>
    @if (session()->has('successMessage'))
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 backdrop-blur-md">
        <div class="bg-green-500 rounded-lg shadow-lg w-80">
            <div class="p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-white font-semibold text-lg">SUCCESS</h2>
                <p class="text-white my-2">{{ session('successMessage') }}</p>
                <a href="{{ route('orders.create') }}" class="mt-4 bg-white text-green-500 rounded-full px-4 py-2">Continue</a>
            </div>
        </div>
    </div>
    @endif
    
    @if (session()->has('errorMessage'))
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 backdrop-blur-md">
        <div class="bg-red-500 rounded-lg shadow-lg w-80">
            <div class="p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="bg-white rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-white
                font-semibold text-lg">ERROR</h2>
                <p class="text-white
                my-2">{{ session('errorMessage') }}</p>
                <a href="{{ route('orders.create') }}" class="mt-4 bg-white text-red-500 rounded-full px-4 py-2">Continue</a>
            </div>
        </div>
    </div>
    @endif
    
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Create Order</h1>

        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name:</label>
                <input type="text"
                    wire:model="customer_name"
                    required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-500" />
                @error('customer_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date:</label>
                <input type="date"
                    wire:model="order_date"
                    required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-500" />
                @error('order_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-semibold mb-2">Order Details</h3>
                @foreach ($details as $index => $detail)
                <div class="flex mb-4">
                    <div class="w-1/2 pr-2">
                        <label for="item_id" class="block text-sm font-medium text-gray-700">Item:</label>
                        <select wire:model="details.{{ $index }}.item_id"
                            wire:change="calculateTotalAmount"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-500">
                            <option value="">Select an item</option>
                            @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error("details.$index.item_id") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="w-1/2 pl-2">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
                        <input type="number"
                            wire:model="details.{{ $index }}.quantity"
                            min="1"
                            required
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-500" />
                        @error("details.$index.quantity") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center">
                        <button type="button" wire:click="removeItem({{ $index }})" class="mt-6 ml-2 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">
                            Delete
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" wire:click="addItem" class="mb-4 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">Add Another Item</button>

            <h4 class="text-lg font-semibold mb-2">Total Amount: <span class="font-bold">Rp {{ number_format($total_amount, 2) }}</span></h4>

            <button type="submit" class="w-full mt-4 bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Create Order</button>
        </form>
    </div>
</div>