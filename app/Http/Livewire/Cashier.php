<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cashier extends Component
{
    public $cart = [];

    public function render()
    {
        return view('livewire.cashier', ['products' => Product::all(['id', 'name', 'price']), 'cart' => $this->cart]);
    }

    public function addToCartFromProductList($productId)
    {
        $cart = collect($this->cart);

        if ($cart->firstWhere('id', $productId)) {
            $this->cart = $cart->map(function ($product) use ($productId) {
                if ($product['id'] === $productId) {
                    $product['quantity']++;
                }
                return $product;
            })->toArray();
            return;
        }

        $this->cart[] = Product::select(['id', 'name', 'price'])->find($productId)->toArray() + ['quantity' => 1];
    }

    public function cartPlus($index)
    {
        $this->cart[$index]['quantity']++;
    }

    public function cartMinus($index)
    {
        if ($this->cart[$index]['quantity'] - 1 === 0) {
            unset($this->cart[$index]);
            return;
        }

        $this->cart[$index]['quantity']--;
    }

    public function save()
    {
        $products = array_map(function ($product) {
            return array_merge($product, ['product_id' => $product['id']]);
        }, $this->cart);

        $amountReceivable = array_reduce($this->cart, function ($sum, $product) {
            $sum += $product['price'] * $product['quantity'];
            return $sum;
        }, 0);

        DB::transaction(function () use ($products, $amountReceivable) {
            $order = auth()->user()->orders()->create([
                'status' => Order::STATUS['holding'],
                'amount_received' => 0,
                'amount_receivable' => $amountReceivable,
            ]);
            foreach ($products as $product) {
                $order->products()->create($product);
            }
        });

        $this->cart = [];
    }
}
