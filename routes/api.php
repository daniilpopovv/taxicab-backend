<?php

declare(strict_types=1);

use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;


Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'getAll']);
});

Route::prefix('order')->group(function () {
    Route::post('/', [OrderController::class, 'create']);
    Route::put('/{order}/cancel', [OrderController::class, 'cancel']);
});


