<?php

use App\Http\Controllers\v1\TicketSellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::get('/events', [TicketSellerController::class, 'getEvents'])
        ->name('getEvents');
    Route::get('/events/{eventId}/lists', [TicketSellerController::class, 'getEventLists'])
        ->name('getEventLists');
    Route::get('/list/{listId}/places', [TicketSellerController::class, 'getListPlaces'])
        ->name('getListPlaces');
    Route::post('/list/{listId}/reserve', [TicketSellerController::class, 'makeReservation'])
        ->name('makeReservation');
});

