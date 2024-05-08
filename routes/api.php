<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('stores')->group(function () {
    Route::get('/', [StoreController::class, 'index']);
    Route::post('/', [StoreController::class, 'store']);
    Route::put('/{id}', [StoreController::class, 'update']);
    Route::delete('/{id}', [StoreController::class, 'destroy']);
    Route::get('/{id}/books', [StoreController::class, 'books']);
    Route::delete('remove/{idStore}/{idBook}', [StoreController::class, 'deleteBook']);
});

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::post('/', [BookController::class, 'store']);
    Route::put('/{id}', [BookController::class, 'update']);
    Route::delete('/{id}', [BookController::class, 'destroy']);
    Route::get('/{id}/stores', [BookController::class, 'stores']);
});
