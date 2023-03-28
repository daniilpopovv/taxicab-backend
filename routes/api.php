<?php

declare(strict_types=1);

use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/order', [OrderController::class, 'store']);
Route::put('/orders/{id}/cancel', [OrderController::class, 'cancel']);
