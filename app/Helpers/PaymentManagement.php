<?php

namespace App\Helpers;

use App\Models\PaymenthMethod;
use Illuminate\Support\Facades\Cookie;

class PaymentManagement {

    static public function addMethodToCookie($method_value)
    {

        $payment_method = PaymenthMethod::where('value', $method_value)->first();

        Cookie::queue('payment_method', json_encode(['method_id' => $payment_method->id, 'method_value' => $payment_method->value, 'method_cost' => $payment_method->cost]), 60 * 24 * 30);
    }

    static public function getMethodFromCookie() {
        $payment_method = json_decode(Cookie::get('payment_method'), true);

        if(!$payment_method) {
            $payment_method = [];
        }

        return $payment_method;
    }

    static public function clearMethod() {
        Cookie::queue(Cookie::forget('payment_method'));
    }
}