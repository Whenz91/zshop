<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use App\Models\Category;
use App\Models\FilterGroup;
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
    #[Url]
    public $selected_filters = [];
    #[Url]
    public $price_range = 100000;
    #[Url]
    public $sort = 'price_asc';

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    //add to cart method
    public function addToCart($product_id) 
    {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        $this->dispatch('show-toast', 'A termék sikeresen hozzáadva a kosárhoz!');
    }

    public function render()
    {
        //$productsQuery = Product::query()->where('is_active', 1);
        
        $productsQuery = Product::whereRelation(
            'categories', 'slug', '=', $this->slug
        )->where('is_active', 1)
         ->with('filters', 'categories');

        
        if (!empty($this->selected_filters)) {
             $productsQuery->whereHas('filters', function($query) {
                 $query->whereIn('filter_options_id', $this->selected_filters);
             });
        }

        if (!empty($this->stock_info)) {
            $productsQuery->when($this->stock_info == 'in_stock', function($query) {
                $query->where('quantity', '>=', 1);
            })
            ->when($this->stock_info == 'preorder', function($query) {
                $query->where('quantity', '<', 1);
            });
        }
        
        if($this->price_range) {
            $productsQuery->whereBetween('price', [0, $this->price_range]);
        }

       if($this->sort == 'price_asc') {
            $productsQuery->orderBy('price', 'ASC');
       }
       if($this->sort == 'price_desc') {
            $productsQuery->orderBy('price', 'DESC');
       }

        return view('livewire.products-page', [
            'products' => $productsQuery->paginate(10),
            'filter_groups' => FilterGroup::where('is_active', 1)->with('options')->get(),
        ]);
    }
}
