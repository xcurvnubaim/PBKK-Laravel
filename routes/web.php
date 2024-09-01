<?php

use App\Livewire\Items;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/items', Items::class);

Route::fallback(function () {
    return view('not-found');
});