<?php

namespace App\Http\Livewire;

use App\Facades\CartHelperFacade;
use Livewire\Component;

class Header extends Component
{
    public $cartTotal = 0;

    protected $listeners = [
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal',
    ];

    public function mount()
    {
        $this->cartTotal = count(CartHelperFacade::get()['products']);
    }

    public function render()
    {
        return view('livewire.header');
    }

    public function updateCartTotal()
    {
        $this->cartTotal = count(CartHelperFacade::get()['products']);
    }
}
