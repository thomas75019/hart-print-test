<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', [OrderController::class, 'index'])->name('index');
Route::get('/create/order', [OrderController::class, 'create'])->name('create');

Route::post('/create/order', [OrderController::class, 'store'])->name('store');