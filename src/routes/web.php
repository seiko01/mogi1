<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/sell', [ItemController::class, 'create'])->name('item.sell');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    Route::get('/profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
    Route::patch('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])->name('purchase');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'processPurchase'])->name('purchase.process');
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress'])->name('purchase.address');
    Route::patch('/purchase/address/{item_id}', [PurchaseController::class, 'processUpdateAddress'])->name('purchase.address.update');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
