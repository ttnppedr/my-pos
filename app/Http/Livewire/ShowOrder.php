<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class ShowOrder extends Component
{
    public $order;
    public $cart;

    public $showNewProductModal = false;
    public $note;
    public $newProductName;
    public $newProductPrice;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->cart = collect($order->products)->toArray();
        $this->note = $order->note;
    }

    public function render()
    {
        return view('livewire.show-order', [
            'products' => Product::all(),
            'amountReceivable' => $this->calculateAmountReceivable(),
        ]);
    }

    public function calculateAmountReceivable()
    {
        return array_reduce($this->cart, function ($sum, $product) {
            $sum += $product['price'] * $product['quantity'];
            return $sum;
        }, 0);
    }

    public function addToCartFromProductList($productId)
    {
        $cart = collect($this->cart);
        $product = Product::select(['id', 'name', 'price'])->find($productId)->toArray();

        if ($cart->where('name', $product['name'])->where('price', $product['price'])->count() > 0) {
            $this->cart = $cart->map(function ($item) use ($product) {
                if ($item['name'] === $product['name'] && $item['price'] === $product['price']) {
                    $item['id'] = $product['id'];
                    $item['quantity']++;
                }
                return $item;
            })->toArray();
            return;
        }

        $this->cart[] = $product + ['quantity' => 1];
    }

    public function addNewToCart()
    {
        $cart = collect($this->cart);

        if ($cart->where('name', $this->newProductName)->where('price', $this->newProductPrice)->count() > 0) {
            $this->cart = $cart->map(function ($item) {
                if ($item['name'] === $this->newProductName && $item['price'] === (int) $this->newProductPrice) {
                    $item['quantity']++;
                }
                return $item;
            })->toArray();
            $this->resetNewProduct();
            $this->closeNewProductModal();
            return;
        }

        $this->cart[] = [
            'name' => $this->newProductName,
            'price' => (int) $this->newProductPrice,
            'quantity' => 1,
        ];

        $this->resetNewProduct();
        $this->closeNewProductModal();
    }
}
