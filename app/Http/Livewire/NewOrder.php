<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewOrder extends Component
{
    public $cart = [];

    public $showNewProductModal = false;
    public $note;
    public $newProductName;
    public $newProductPrice;

    public function render()
    {
        return view('livewire.new-order', [
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

    protected function resetNewProduct()
    {
        $this->newProductName = null;
        $this->newProductPrice = null;
    }

    public function closeNewProductModal()
    {
        $this->showNewProductModal = false;
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

    public function cartItemDelete($index)
    {
        unset($this->cart[$index]);
    }

    public function save()
    {
        $products = array_map(function ($product) {
            return array_merge($product, ['product_id' => $product['id'] ?? null]);
        }, $this->cart);

        $order = $this->createOrder($products);

        return redirect()->route('show-order', ['order' => $order]);
    }

    public function createOrder($products)
    {
        return DB::transaction(function () use ($products) {
            $order = auth()->user()->orders()->create([
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

    public function clearCart()
    {
        $this->cart = [];
    }
}
