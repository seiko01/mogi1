<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ItemLikeController;
use Illuminate\Support\Facades\Auth;

Route::get('/redirect-after-login', function () {
    $user = Auth::user();

if ($user && $user->profile && $user->profile->postcode && $user->profile->address) {
        return redirect('/');
    } else {
        return redirect('/profile_edit');
    }
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/search', [ItemController::class, 'search'])->name('items.search');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');
Route::post('/like/{id}', [ItemLikeController::class, 'store'])->name('like.store');
Route::delete('/like/{id}', [ItemLikeController::class, 'destroy'])->name('like.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/sell', [ItemController::class, 'create'])->name('sell');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    Route::get('/profile_edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile_edit', [UserController::class, 'profileUpdate'])->name('profile.update.post');
    Route::get('/purchase/{item}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::patch('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])->name('purchase.process');

    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'editAddress'])->name('purchase.address.edit');
    Route::patch('/purchase/address/{item_id}', [PurchaseController::class, 'updateAddress'])->name('purchase.address.update');

    Route::post('/comments/store/{item}', [CommentController::class, 'store'])->name('comments.store');

});
