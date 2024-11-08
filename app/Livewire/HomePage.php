<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Home - Zolárium')]

class HomePage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();

        return view('livewire.home-page', compact('categories'));
    }
}
