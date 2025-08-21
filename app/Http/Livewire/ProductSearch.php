<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductSearch extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = Product::query()
            ->where('name', 'like', '%' . $this->query . '%')
            ->orWhere('description', 'like', '%' . $this->query . '%')
            ->orWhereHas('category', function ($q) {
                $q->where('name', 'like', '%' . $this->query . '%');
            })
            ->with('category')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
