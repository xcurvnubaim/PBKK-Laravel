@extends('layouts.test')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Items List</h1>
    <a href="{{ route('v2.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-500">Create New Item</a>
    
    <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Name</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Stock</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Price</th>
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2 text-gray-700">{{ $item->name }}</td>
                    <td class="px-4 py-2 text-gray-700">{{ $item->stock }}</td>
                    <td class="px-4 py-2 text-gray-700">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 flex items-center space-x-4">
                        <a href="{{ route('v2.show', $item->id) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('v2.edit', $item->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('v2.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
