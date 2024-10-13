<div class="m-5">
    @if($isOpen)
    @include('livewire.items.create')
    @endif

    <button wire:click="create()" class="btn bg-purple-600 text-white px-3 py-2 rounded-md">Create New Item</button>

    @if (session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('message') }}
    </div>

    @endif

    <hr class="my-5">

    <table class="table-fixed w-full">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700 dark:text-white">
                <th class="dark:border-gray-500 w-16 px-4 py-2">No</th>
                <th class="dark:border-gray-500 px-4 py-2">Item Name</th>
                <th class="dark:border-gray-500 px-4 py-2">Item Stok</th>
                <th class="dark:border-gray-500 px-4 py-2">Item Price</th>
                <th class="dark:border-gray-500 px-4 py-2">Category</th>
                <th class="dark:border-gray-500 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td class="border dark:border-gray-500 text-center px-4 py-2 dark:text-white">{{ $index + 1 }}</td>
                <td class="border dark:border-gray-500 text-center px-4 py-2 dark:text-white">{{ $item->name }}</td>
                <td class="border dark:border-gray-500 text-center px-4 py-2 dark:text-white">{{ $item->stock }}</td>
                <td class="border dark:border-gray-500 px-4 py-2 dark:text-white">
                    <div class="flex justify-center">
                        <span>Rp.{{ number_format($item->price, 0, ',', '.') }}</span>
                    </div>
                </td>
                <td class="border dark:border-gray-500 text-center px-4 py-2 dark:text-white">{{ $item->category->category_name }}</td>
                <td class="border dark:border-gray-500 text-center py-2 gap-4 flex justify-center">
                    <button wire:click="edit({{ $item->id }})" class="btn bg-blue-600 text-white px-3 py-2 rounded-md">Edit</button>
                    <button wire:click="delete({{ $item->id }})" class="btn bg-red-600 text-white px-3 py-2 rounded-md">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>