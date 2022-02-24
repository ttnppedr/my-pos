<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    public function deleting(Order $order)
    {
        $order->products()->delete();
    }
}
