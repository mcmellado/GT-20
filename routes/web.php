<?php

use App\Http\Controllers\SolarCalculatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SolarCalculatorController::class, 'index'])
    ->name('calculator.show');

Route::post('/calcular', [SolarCalculatorController::class, 'store'])
    ->name('calculator.store');


use Illuminate\Http\Request;

Route::post('/calculadora/lead', function (Request $request) {
    return response()->json(['ok' => true]);
})->name('calculadora.lead');
