<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Pénztár - Zolárium')]
class CheckoutPage extends Component
{
    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $total_summary = CartManagement::calculateTotalSummary($cart_items);

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'total_summary' => $total_summary
        ]);
    }
}
