<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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
    public $shipping_country = '';
    public $shipping_state = '';
    public $shipping_zipcode = '';
    public $shipping_city = '';
    public $shipping_street = '';

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

        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_items = [];

        foreach($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'huf',
                    'unit_amount' => $item['price'] * 100,
                    'product_data' => [
                        'name' => $item['name']
                    ]
                    ],
                'quantity' => $item['quantity']
            ];
        }

        $order = new Order();
        $order->customer_name = $this->customer_name;
        $order->customer_email = $this->customer_email;
        $order->customer_phone = $this->customer_phone;
        $order->billing_country = $this->billing_country;
        $order->billing_state = $this->billing_state;
        $order->billing_zipcode = $this->billing_zipcode;
        $order->billing_city = $this->billing_city;
        $order->billing_street = $this->billing_street;
        $order->shipping_country = $this->shipping_country != '' ? $this->shipping_country  : $this->billing_country;
        $order->shipping_state = $this->shipping_state != '' ? $this->shipping_state  : $this->billing_state;
        $order->shipping_zipcode = $this->shipping_zipcode != '' ? $this->shipping_zipcode  : $this->billing_zipcode;
        $order->shipping_city = $this->shipping_city != '' ? $this->shipping_city  : $this->billing_city;
        $order->shipping_street = $this->shipping_street != '' ? $this->shipping_street  : $this->billing_street;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->status = 'new';
        $order->currency = 'huf';
        $order->shipping_method = $this->shipping_method;
        $order->shiping_amount = 0;
        $order->notes = '';

        $redirect_url = '';

        if($this->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_type' => ['card'],
                'customer_email' => $this->customer_email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success_order') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel_order')
            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            $redirect_url = route('success_order');
        }

        $order->save();
        //le kezelem, ha más model-nek kell az order_id
        //$address->orderId = $order->id;
        //$address->save();
        $order->orderItems()->createMany(CartManagement::transformCartItemsToOrderItems());
        CartManagement::clearCartItems();
        
        return redirect($redirect_url);
     }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $total_summary = CartManagement::calculateTotalSummary($cart_items);

        /**
         * TODO render shipping_methods and payment_methods form DB
         */

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'total_summary' => $total_summary
        ]);
    }
}
