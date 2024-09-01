<?php

use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1')->group(function () {
    Route::prefix('/item')->group(function () {
        Route::get('/', [ItemController::class, 'index']);
        Route::post('/', 'ItemController@store');
        Route::get('/{id}', 'ItemController@show');
        Route::put('/{id}', 'ItemController@update');
        Route::delete('/{id}', 'ItemController@destroy');
    });
});
