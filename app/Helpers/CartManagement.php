<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement {
    
    /**
     * Add item to cart
     * @return int
     */
    static public function addItemToCart($product_id) {
        $cart_items = self::getCartItemsFromCookie();

        $existing_item =  null;

        foreach($cart_items as $key => $item) {
            if($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['price'];
            $cart_items[$existing_item]['tax_amount'] = $cart_items[$existing_item]['total_amount'] * $cart_items[$existing_item]['tax'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'tax', 'images']);

            if($product) {
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => 1,
                    'price' => $product->price,
                    'tax' => $product->tax,
                    'total_amount' => $product->price,
                    'tax_amount' => $product->price * $product->tax,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);

        return count($cart_items);
    }

    /**
     * Add item to cart with quantity
     * @return int
     */
    static public function addItemToCartWithQty($product_id, $quantity = 1) {
        $cart_items = self::getCartItemsFromCookie();

        $existing_item =  null;

        foreach($cart_items as $key => $item) {
            if($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if($existing_item !== null) {
            $cart_items[$existing_item]['quantity'] = $quantity;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['price'];
            $cart_items[$existing_item]['tax_amount'] = $cart_items[$existing_item]['total_amount'] * $cart_items[$existing_item]['tax'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'tax', 'images']);

            if($product) {
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'tax' => $product->tax,
                    'total_amount' => $product->price * $quantity,
                    'tax_amount' => ($product->price * $product->tax) * $quantity,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);

        return count($cart_items);
    }

    /**
     * Remove item from cart
     * @return array
     */
    static public function removeCartItem($product_id) 
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach($cart_items as $key => $item) {
            if($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    /**
     * Add cart items to Cookie
     * @param array cart_items
     * @return void
     */
    static public function addCartItemsToCookie($cart_items) {
        //store cart items in cookie 30 days
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    /**
     * Clear cart items from Cookie
     * @return void 
    */
    static public function clearCartItems() {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    /**
     * Get all cart items from cookie
     * @return array
     */
    static public function getCartItemsFromCookie() {
        $cart_items = json_decode(Cookie::get('cart_items'), true);

        if(!$cart_items) {
            $cart_items = [];
        }

        return $cart_items;
    }
    
    //tarnsform cart_items to order_items
    static public function transformCartItemsToOrderItems() {
        $cart_items = self::getCartItemsFromCookie();

        $order_items = [];

        foreach($cart_items as $item) {
            $order_items[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['price'],
                'total_amount' => $item['total_amount']
            ];
        }

        return $order_items;
    }

    //increment item quantity
    static public function incrementQuantityToCartItem($product_id) 
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach($cart_items as $key => $item) {
            if($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['price'];
                $cart_items[$key]['tax_amount'] = $cart_items[$key]['total_amount'] * $cart_items[$key]['tax'];
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }
    
    //decrement item quantity
    static public function decrementQuantityToCartItem($product_id) 
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach($cart_items as $key => $item) {
            if($item['product_id'] == $product_id) {
                if($cart_items[$key]['quantity'] > 1) {
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['price'];
                    $cart_items[$key]['tax_amount'] = $cart_items[$key]['total_amount'] * $cart_items[$key]['tax'];
                }
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    //calculate grand total
    static public function calculateGrandTotal($items) {
        $grand_net_total = array_sum(array_column($items, 'total_amount'));
        $tax_total = array_sum(array_column($items, 'tax_amount'));

        return  ($grand_net_total + $tax_total);
    }

    /**
     * Return order calculated net, tax and gross total amount
     */
    static public function calculateTotalSummary($items) {
        $shipping_method = ShippingManagement::getMethodFromCookie();
        $payment_method = PaymentManagement::getMethodFromCookie();

        $grand_net_total = array_sum(array_column($items, 'total_amount'));
        $tax_total = array_sum(array_column($items, 'tax_amount'));
        $shipping_cost = 0;
        $payment_cost = 0;

        if($shipping_method) {
            $shipping_cost = $shipping_method['method_cost'];
        }
        if($payment_method) {
            $payment_cost = $payment_method['method_cost'];
        }

        $grand_gross_total = $grand_net_total + $tax_total + $shipping_cost + $payment_cost;

        return [
            'grand_net_total' => $grand_net_total,
            'tax_total' => $tax_total,
            'shipping_cost' => $shipping_cost,
            'payment_cost' => $payment_cost,
            'grand_gross_total' => $grand_gross_total
        ];
    }

}