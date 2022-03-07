<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        return view('livewire.orders', [
            'orders' => Order::where('status', Order::STATUS['holding'])->with(['products'])->get(),
        ]);
    }
}
