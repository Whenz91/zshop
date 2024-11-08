<?php

namespace App\Livewire;

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
    public $selected_size = [];

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

        
        if(!empty($this->selected_size)) {
            $productsQuery->whereRelation(
                'filters', 'filter_options_id', 'IN', '1,2'
            );
        }

        /*
        if(!empty($this->selected_size)) {
            $productsQuery->get()->load(['filters']);
            $productsQuery->whereIn('filters.filter_options_id', $this->selected_size);
        }
            */

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
            'categories' => Category::where('is_active', 1)->get(['id', 'title', 'slug']),
            'filter_groups' => FilterGroup::where('is_active', 1)->with('options')->get(),
        ]);
    }
}
