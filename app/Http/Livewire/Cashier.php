<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cashier extends Component
{
    public $cart = [];

    public function render()
    {
        return view('livewire.cashier', ['products' => Product::all(['id', 'name', 'price'])]);
    }

    public function addToCart($productId)
    {

        $this->cart[] = Product::where('id', $productId)->first(['id', 'name', 'price'])->toArray() + ['quantity' => 1];
    }

    public function cartPlus($index)
    {
        dd($index);
        $this->cart[$index]['quantity']++;
    }
}
