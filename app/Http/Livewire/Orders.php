<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        return view('livewire.orders', [
            'orders' => Order::where('created_at', '>=',
                Carbon::now()->subDay())->orderBy('status')->orderBy('created_at', 'desc')->with(['products'])->get(),
        ]);
    }

    public function redirectTo($orderId)
    {
        return redirect()->route('show-order', ['order' => $orderId]);
    }
}
