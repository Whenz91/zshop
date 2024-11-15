<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;

#[Title('Kosár - Zolárium')]
class CartPage extends Component
{

    public $cart_items = [];
    public $grand_total;
    public $net_total;
    public $tax;

    public function calculateTotals() {
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->net_total = $this->grand_total / 1.27;
        $this->tax = $this->grand_total - $this->net_total;
    }

    public function mount() {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->calculateTotals();
    }
    
    public function removeItem($product_id) {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->calculateTotals();

        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQty($product_id) {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->calculateTotals();
    }

    public function decreaseQty($product_id) {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->calculateTotals();
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
