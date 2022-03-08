<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class NewOrder extends Component
{
    public function render()
    {
        return view('livewire.new-order', [
            'products' => Product::all(),
        ]);
    }
}
