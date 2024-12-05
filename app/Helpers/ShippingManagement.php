<?php

namespace App\Helpers;

use App\Models\ShippingMethod;
use Illuminate\Support\Facades\Cookie;

class ShippingManagement {

    static public function addMethodToCookie($method_value)
    {

        $shipping_method = ShippingMethod::where('value', $method_value)->first();

        Cookie::queue('shipping_method', json_encode(['method_id' => $shipping_method->id, 'method_value' => $shipping_method->value, 'method_cost' => $shipping_method->cost]), 60 * 24 * 30);
    }

    static public function getMethodFromCookie() {
        $shipping_method = json_decode(Cookie::get('shipping_method'), true);

        if(!$shipping_method) {
            $shipping_method = [];
        }

        return $shipping_method;
    }

    static public function clearMethod() {
        Cookie::queue(Cookie::forget('shipping_method'));
    }
}