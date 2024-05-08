<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('stores')->name('stores.')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::post('/', [StoreController::class, 'store'])->name('store');
    Route::put('/{id}', [StoreController::class, 'update'])->name('update');
    Route::delete('/{id}', [StoreController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/books', [StoreController::class, 'books'])->name('books');
    Route::delete('remove/{idStore}/{idBook}', [StoreController::class, 'deleteBook'])->name('deleteBook');
});

Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::post('/', [BookController::class, 'store'])->name('store');
    Route::put('/{id}', [BookController::class, 'update'])->name('update');
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/stores', [BookController::class, 'stores'])->name('stores');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::prefix('api')->group(function () {
//     Route::prefix('login-response')->name('login-response.')->group(function () {
//         Route::get('/success', function () {
//             return 'Login authentication complete';
//         })->name('success');

//         Route::post('/failed', function () {
//             return 'Error logging in';
//         })->name('failed');
//     });

//     Route::post('/logout-response', function() {
//         return 'Logout successful';
//     })->name('logout-response');
// });