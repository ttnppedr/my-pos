<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowOrder extends Component
{
    public $order;
    public $carts;
    public $orderCarts;

    public $note;
    public $newProductName;
    public $newProductPrice;
    public $amountReceived;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->orderCarts = $order->products->toArray();
        $this->carts = [];
        $this->note = $order->note;
    }

    public function render()
    {
        return view('livewire.show-order', [
            'products' => Product::all(),
            'orderCarts' => $this->orderCarts,
            'carts' => $this->carts,
            'amountReceivable' => $this->calculateAmountReceivable(),
        ]);
    }

    public function calculateAmountReceivable()
    {
        return array_reduce($this->carts, function ($sum, $product) {
            $sum += $product['price'] * $product['quantity'];
            return $sum;
        }, 0);
    }

    public function deleteOrder()
    {
        $this->order->delete();

        return redirect()->route('orders');
    }

    public function save()
    {
        $products = array_map(function ($cart) {
            $productId = isset($cart['order_id']) ? $cart['product_id'] ?? null : $cart['id'] ?? null;
            return array_merge($cart, ['product_id' => $productId]);
        }, $this->carts);

        $this->updateOrder($products);

        return redirect()->route('show-order', ['order' => $this->order]);
    }

    public function updateOrder($products)
    {
        DB::transaction(function () use ($products) {
            $this->order->update([
                'amount_receivable' => $this->calculateAmountReceivable(),
            ]);
            foreach ($this->order->products as $product) {
                $product->delete();
            }
            foreach ($products as $product) {
                $this->order->products()->create($product);
            }
            $this->order->update(['note' => $this->note]);
        });
    }

    public function checkout()
    {
        $this->order->update([
            'status' => Order::STATUS['completed'],
            'amount_received' => (int) $this->amountReceived,
        ]);

        return redirect()->route('orders');
    }
}
