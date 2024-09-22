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
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Item Name</th>
                <th class="px-4 py-2">Item Stok</th>
                <th class="px-4 py-2">Item Price</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->name }}</td>
                <td class="border px-4 py-2">{{ $item->stock }}</td>
                <td class="border px-4 py-2">{{ $item->price }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $item->id }})" class="btn bg-blue-600 text-white px-3 py-2 rounded-md">Edit</button>
                    <button wire:click="delete({{ $item->id }})" class="btn bg-red-600 text-white px-3 py-2 rounded-md">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>