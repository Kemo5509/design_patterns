<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::post('pay', [CheckoutController::class, 'pay']);
    Route::post('/pay-without-factory', [CheckoutController::class, 'payWithoutFactory']);
});
