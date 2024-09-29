@extends('layouts.test')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">{{ $item->name }}</h1>
    <p class="mb-2"><strong>Stock:</strong> {{ $item->stock }}</p>
    <p class="mb-4"><strong>Price:</strong> Rp{{ number_format($item->price, 0, ',', '.') }}</p>

    <a href="{{ route('v2.index') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-500">Back to Items</a>
</div>
@endsection
