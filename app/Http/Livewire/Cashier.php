<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cashier extends Component
{
    public $showNewProductModal = false;
    public $newProductName = '';
    public $newProductPrice = '';
    public $showCheckoutModal = false;
    public $amountReceived = null;
    public $cart = [];
    public $viewing = 'product';
    public $orderId;

    public function render()
    {
        return view('livewire.cashier', [
            'products' => Product::all(['id', 'name', 'price']),
            'orders' => Order::where('status', Order::STATUS['holding'])->with(['products'])->get(['id', 'amount_receivable']),
            'cart' => $this->cart,
            'amountReceivable' => $this->calculateAmountReceivable(),
        ]);
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
                if ($item['name'] === $this->newProductName && $item['price'] === (int)$this->newProductPrice) {
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
            'price' => (int)$this->newProductPrice,
            'quantity' => 1,
        ];

        $this->resetNewProduct();
        $this->closeNewProductModal();
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

        $this->orderId === null ? $this->createOrder($products) : $this->updateOrder($products);

        $this->clear();
    }

    public function createOrder($products)
    {
        DB::transaction(function () use ($products) {
            $order = auth()->user()->orders()->create([
                'status' => Order::STATUS['holding'],
                'amount_received' => 0,
                'amount_receivable' => $this->calculateAmountReceivable(),
            ]);
            foreach ($products as $product) {
                $order->products()->create($product);
            }
        });
    }

    public function updateOrder($products)
    {
        $order = Order::find($this->orderId);
        DB::transaction(function () use ($order, $products) {
            $order->update([
                'amount_receivable' => $this->calculateAmountReceivable(),
            ]);
            foreach ($order->products as $product) {
                $product->delete();
            }
            foreach ($products as $product) {
                $order->products()->create($product);
            }
        });
    }

    public function calculateAmountReceivable()
    {
        return array_reduce($this->cart, function ($sum, $product) {
            $sum += $product['price'] * $product['quantity'];
            return $sum;
        }, 0);
    }

    public function clear()
    {
        $this->cart = [];
        $this->orderId = null;
        $this->amountReceived = null;
    }

    public function resetNewProduct()
    {
        $this->newProductName = '';
        $this->newProductPrice = '';
    }

    public function openNewProductModal()
    {
        $this->showNewProductModal = true;
    }

    public function closeNewProductModal()
    {
        $this->showNewProductModal = false;
    }

    public function openCheckoutModal()
    {
        $this->amountReceived = $this->calculateAmountReceivable();
        $this->showCheckoutModal = true;
    }

    public function closeCheckoutModal()
    {
        $this->showCheckoutModal = false;
    }

    public function viewOrder()
    {
        $this->viewing = 'order';
        $this->clear();
    }

    public function viewProduct()
    {
        $this->viewing = 'product';
    }

    public function showOrderContent($orderId)
    {
        $this->orderId = $orderId;
        $order = Order::with(['products'])->find($orderId);
        $this->cart = collect($order->products->map(function ($product) {
            return $product->only(['id', 'name', 'price', 'quantity']);
        }))->toArray();
    }

    public function checkout()
    {
        $this->save();

        Order::find($this->orderId)->update([
            'status' => Order::STATUS['completed'],
            'amount_received' => (int)$this->amountReceived,
        ]);
        $this->clear();
        $this->closeCheckoutModal();
    }
}
