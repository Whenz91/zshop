<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Termékek - Zolárium')]
class ProductsPage extends Component
{
    use WithPagination;
    
    
    public $slug;
    #[Url]
    public $stock_info = '';

    public function mount($slug)
    {
        $this->slug = $slug;
    }


    public function render()
    {
        //$productsQuery = Product::query()->where('is_active', 1);
        
        $productsQuery = Product::whereRelation(
            'categories', 'slug', '=', $this->slug
        )->where('is_active', 1);


        if(!empty($this->stock_info)) {
            if($this->stock_info == "in_stock") {
                $productsQuery->where('quantity', '>=', 1);
            }
            if($this->stock_info == "preorder") {
                $productsQuery->where('quantity', '<', 1);
            }
        } else {
            $productsQuery;
        }

        return view('livewire.products-page', [
            'products' => $productsQuery->paginate(10),
            'categories' => Category::where('is_active', 1)->get(['id', 'title', 'slug'])
        ]);
    }
}
