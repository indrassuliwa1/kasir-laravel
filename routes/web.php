<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ✅ Import controller
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route untuk halaman web aplikasi kasir.
|
*/

// ✅ Route Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ✅ Dashboard admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// ✅ Modul Transaksi & Barang
Route::get('/transaction-details', [TransactionDetailController::class, 'index'])->name('transaction-details.index');

Route::resource('items', ItemController::class);

Route::resource('item-categories', ItemCategoryController::class);
// Penting: gunakan dash (-) karena ini mempengaruhi nama route-nya
// seperti item-categories.index, item-categories.store, dll.

Route::resource('cart', CartController::class)->only(['store', 'destroy']);

Route::resource('transactions', TransactionController::class)->only(['store', 'index']);
