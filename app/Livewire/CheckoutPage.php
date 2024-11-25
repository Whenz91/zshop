<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Pénztár - Zolárium')]
class CheckoutPage extends Component
{

    public $customer_name;
    public $customer_email;
    public $customer_phone;
    public $billing_country = 'Magyarország';
    public $billing_state = "please_select";
    public $billing_zipcode;
    public $billing_city;
    public $billing_street;
    public $shipping_method = 'house';
    public $payment_method = 'cod';
    public $shipping_country;
    public $shipping_state;
    public $shipping_zipcode;
    public $shipping_city;
    public $shipping_street;

    public function placeOrder() {
        $this->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'billing_country' => 'required',
            'billing_state' => 'required',
            'billing_zipcode' => 'required',
            'billing_city' => 'required',
            'billing_street' => 'required',
        ]);
    }

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
