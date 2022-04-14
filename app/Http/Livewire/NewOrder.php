<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewOrder extends Component
{
    public $carts = [];

    public $showNewProductModal = false;
    public $note;
    public $newProductName;
    public $newProductPrice;

    public function render()
    {
        return view('livewire.new-order', [
            'products' => Product::all(),
        ]);
    }

    public function calculateAmountReceivable()
    {
        return array_reduce($this->carts, function ($sum, $cart) {
            $sum += $cart['price'] * $cart['quantity'];
            return $sum;
        }, 0);
    }

    public function save()
    {
        $products = array_map(function ($product) {
            return array_merge($product, ['product_id' => $product['id'] ?? null]);
        }, $this->carts);

        $order = $this->createOrder($products);

        return redirect()->route('show-order', ['order' => $order]);
    }

    public function createOrder($products)
    {
        return DB::transaction(function () use ($products) {
            $order = auth()->user()->orders()->create([
                'team_id' => auth()->user()->team_id,
                'status' => Order::STATUS['holding'],
                'amount_received' => 0,
                'amount_receivable' => $this->calculateAmountReceivable(),
            ]);
            foreach ($products as $product) {
                $order->products()->create($product);
            }
            $order->update(['note' => $this->note ?? $order->id]);

            return $order;
        });
    }
}
