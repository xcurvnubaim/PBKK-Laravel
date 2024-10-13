<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Livewire\OrderDetails;
use App\Livewire\OrderForm;
use App\Livewire\Orders;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::resource('/item/v2', App\Http\Controllers\ItemController::class);
    Route::middleware('role:admin')->group(function () {});
    Route::get('/item', App\Livewire\ItemController::class)->name('item');
    Route::get('/orders', Orders::class)->name('orders.index');
    Route::get('/orders/create', OrderForm::class)->name('orders.create');
    Route::get('/orders/{orderId}', OrderDetails::class)->name('orders.show');
    Route::get('/utility/404', function () {
        return view('pages/utility/404');
    })->name('404');

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});
