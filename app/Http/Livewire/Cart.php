<?php

namespace App\Http\Livewire;

use App\Facades\CartHelperFacade;
use Livewire\Component;

class Cart extends Component
{
    public $cart;

    public function mount()
    {
        $this->cart = CartHelperFacade::get();
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function removeFromCart($productId): void
    {
        CartHelperFacade::remove($productId);
        $this->cart = CartHelperFacade::get();
    }

    public function checkout()
    {
        CartHelperFacade::clear();
        $this->cart = CartHelperFacade::get();
    }
}
