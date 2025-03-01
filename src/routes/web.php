<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;

    Route::get('/', [ItemController::class, 'index'])->name('items.index');

    Route::middleware('auth')->group(function () {
        Route::get('/mypage', [UserController::class, 'mypage'])->name('user.mypage');
        Route::get('/sell', [ItemController::class, 'sell'])->name('item.sell');
    });