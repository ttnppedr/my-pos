<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cashier extends Component
{
    public function render()
    {
        return view('livewire.cashier', ['products' => Product::all(['id', 'name', 'price'])]);
    }
}
