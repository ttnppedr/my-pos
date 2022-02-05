<?php

namespace App\Http\Livewire;

use App\Facades\CartHelperFacade;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->search === null ?
                Product::paginate(12) :
                Product::where('name', 'like', '%' . $this->search . '%')->paginate(12)
        ]);
    }

    public function addToCart(int $productId): void
    {
        CartHelperFacade::add(Product::where('id', $productId)->first());
    }
}
