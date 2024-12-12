<?php

namespace App\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;
use Stripe\Checkout\Session;
use App\Models\PaymenthMethod;
use App\Models\ShippingMethod;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Helpers\PaymentManagement;
use App\Helpers\ShippingManagement;

#[Title('Pénztár - Zolárium')]
class CheckoutPage extends Component
{

    public $user_id = 0;
    public $customer_name;
    public $customer_email;
    public $customer_phone;
    public $billing_country = 'Magyarország';
    public $billing_state;
    public $billing_zipcode;
    public $billing_city;
    public $billing_street;
    public $shipping_method;
    public $payment_method;
    public $dif_address = false;
    public $shipping_country = '';
    public $shipping_state = '';
    public $shipping_zipcode = '';
    public $shipping_city = '';
    public $shipping_street = '';

    public $cart_items;
    public $total_summary;

    public $shipping_fee = 0;
    public $payment_fee = 0;

    public function mount() {
        if(auth()->user()) {
            $this->user_id = auth()->user()->id;
            $this->customer_name = auth()->user()->name;
            $this->customer_email = auth()->user()->email;

            $billing_address = Address::where('user_id', $this->user_id)->where('type', 'billing')->first();

            $this->billing_country = $billing_address->country;
            $this->billing_state = $billing_address->state;
            $this->billing_zipcode = $billing_address->zipcode;
            $this->billing_city = $billing_address->city;
            $this->billing_street = $billing_address->street;

            $shipping_address = Address::where('user_id', $this->user_id)->where('type', 'shipping')->first();
            if(!empty($shipping_address)) {
                $this->dif_address = true;
                $this->shipping_country = $shipping_address->country;
                $this->shipping_state = $shipping_address->state;
                $this->shipping_zipcode = $shipping_address->zipcode;
                $this->shipping_city = $shipping_address->city;
                $this->shipping_street = $shipping_address->street;
            }

        }
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->total_summary = CartManagement::calculateTotalSummary($this->cart_items);

        $this->setShippingAndPaymentFees();
    }
    
    public function setShippingAndPaymentFees() {
        $shipping_method = ShippingManagement::getMethodFromCookie();
        $payment_method = PaymentManagement::getMethodFromCookie();
    
        if( $shipping_method) { 
            $this->shipping_method =  $shipping_method['method_value'];
            $this->shipping_fee = $shipping_method['method_cost'];
        }
        if($payment_method) {
            $this->payment_method = $payment_method['method_value'];
            $this->payment_fee = $payment_method['method_cost'];
        }
    }

    #[On('update-shipping')] 
    public function updateShipping()
    {
        if(ShippingManagement::getMethodFromCookie()) {
            ShippingManagement::clearMethod();
            ShippingManagement::addMethodToCookie($this->shipping_method);
            $this->setShippingAndPaymentFees();
            $this->dispatch('update-total');
        } else {
            ShippingManagement::addMethodToCookie($this->shipping_method);
            $this->setShippingAndPaymentFees();
            $this->dispatch('update-total');
        }
    }

    #[On('update-payment')] 
    public function updatePayment()
    {
        if(PaymentManagement::getMethodFromCookie()) {
            PaymentManagement::clearMethod();
            PaymentManagement::addMethodToCookie($this->payment_method);
            $this->setShippingAndPaymentFees();
            $this->dispatch('update-total');
        } else {
            PaymentManagement::addMethodToCookie($this->payment_method);
            $this->setShippingAndPaymentFees();
            $this->dispatch('update-total');
        }
    }
    
    #[On('update-total')]
    public function updateTotal() 
    {
        $this->total_summary = CartManagement::calculateTotalSummary($this->cart_items);
    }

    #[On('state-update')]
    public function updateState($value) {
        if($value['name'] == 'billing_state') {
            $this->billing_state = $value['value'];
        } elseif($value['name'] == 'shipping_state') {
            $this->shipping_state = $value['value'];
        }
    }


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
            'shipping_method' => 'required',
            'payment_method' => 'required',
        ]);


        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_items = [];

        foreach($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'huf',
                    'unit_amount' => (($item['price'] * (1 + $item['tax'])) * 100),
                    'product_data' => [
                        'name' => $item['name']
                    ]
                ],
                'quantity' => $item['quantity']
            ];
        }

        if($this->shipping_fee > 0) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'huf',
                    'unit_amount' => $this->shipping_fee * 100,
                    'product_data' => [
                        'name' => 'Szállítás díja'
                    ]
                ],
                'quantity' => 1
            ];
        }
        if($this->payment_fee) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'huf',
                    'unit_amount' => $this->payment_fee * 100,
                    'product_data' => [
                        'name' => 'Utánvét díja'
                    ]
                ],
                'quantity' => 1
            ];
        }

        $order = new Order();
        $order->user_id = $this->user_id;
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
        $order->shipping_fee = $this->shipping_fee;
        $order->payment_fee = $this->payment_fee;
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
        $order->orderItems()->createMany($cart_items);
        CartManagement::clearCartItems();
        ShippingManagement::clearMethod();
        PaymentManagement::clearMethod();
        
        return redirect($redirect_url);
     }

    public function render()
    {
        return view('livewire.checkout-page', [
            'cart_items' => $this->cart_items,
            'total_summary' => $this->total_summary,
            'shipping_methods' => ShippingMethod::all(),
            'payment_methods' => PaymenthMethod::all()
        ]);
    }
}
