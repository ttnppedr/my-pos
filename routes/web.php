<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', \App\Http\Livewire\Home::class)->name('home');
Route::get('/products', \App\Http\Livewire\Products::class)->name('products');
Route::get('/cart', \App\Http\Livewire\Cart::class)->name('cart');
Route::get('/test', function () {
    return CartH::get();
});

Route::get('/cashier', function () {
    return view('cashier');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
