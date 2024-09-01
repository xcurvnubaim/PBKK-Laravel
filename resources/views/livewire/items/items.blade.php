<div>
    @if($isOpen)
        @include('livewire.items.create')
    @endif

    <button wire:click="create()" class="btn btn-primary">Create New Item</button>
    
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table-fixed w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Item Name</th>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->item_name }}</td>
                <td class="border px-4 py-2">{{ $item->stock }}</td>
                <td class="border px-4 py-2">{{ $item->price }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $item->id }})" class="btn btn-primary">Edit</button>
                    <button wire:click="delete({{ $item->id }})" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
