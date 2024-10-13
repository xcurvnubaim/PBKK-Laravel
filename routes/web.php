<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;

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
Route::get('/logs', function () {
    $data = [];
    // Ambil isi log dari file
    $logContents = file(storage_path('logs\item_activity.log'));
    foreach($logContents as $index=>$lines){
        if (!empty($lines)) {
            $logEntry = json_decode($lines,true); // true untuk mengembalikan array asosiatif
            $data[$index] = $logEntry;
        }
    }
    // dd($data);
    // dd($data);
    return view('livewire\items\items-log', ['logs' =>($data)]);
})->name('item-log');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/item', App\Livewire\ItemController::class)->name('item');
    Route::resource('/item/v2', App\Http\Controllers\ItemController::class);
   
    Route::get('/utility/404', function () {
        return view('pages/utility/404');
    })->name('404');
    
    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});
