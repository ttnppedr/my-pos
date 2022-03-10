<?php

use App\Http\Livewire\NewOrder;
use App\Http\Livewire\Orders;
use App\Http\Livewire\ShowOrder;
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


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/orders', Orders::class)->name('orders');
    Route::get('/new-order', NewOrder::class)->name('new-order');
    Route::get('/show-order/{order}', ShowOrder::class)->name('show-order');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/{any}', function () {
    return redirect()->route('login');
})->where('any', '.*');
