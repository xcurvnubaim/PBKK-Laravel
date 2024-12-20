<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\logController;
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
    Route::get('/orders/create', OrderForm::class)->name('orders.create');
    
    Route::middleware('role:admin')->group(function () {
        Route::get('/item', App\Livewire\ItemController::class)->name('item');
        Route::get('/orders', Orders::class)->name('orders.index');
        Route::get('/orders/{orderId}', OrderDetails::class)->name('orders.show');
        Route::get('/logs', [logController::class, 'index'])->name('item-log');
    });
    
    

    Route::fallback(function () {
        return view('pages/utility/404');
    });
});
