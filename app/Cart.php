<?php

namespace App;
use Illuminate\Support\Facades\Session;
class Cart
{
    public $items;
    public $total;
    public $cartId;
    public $product;
    public $quantity;

    function __construct(){
    }
    /**
     * New Cart object
     *
     * @param Cart $items
     * @param int $total
     * @return Cart
     */
    public static function newCart($items, $total){
        $instance = new Cart();
        $instance->items[$items->product->id] = $items;
        $instance->total = $total;
        return $instance;
    }
    /**
     * New Cart itém object
     *
     * @param int $cartId
     * @param Product $product
     * @param [type] $quantity
     * @return void
     */
    public static function newItems($cartId, $product, $quantity){
        $instance = new Cart();
        $instance->cartId = $cartId;
        $instance->product = $product;
        $instance->quantity = $quantity;
        return $instance;
    }
    /**
     * Add a item to Cart
     * @param int $productId
     * @return void
     */
    public static function add($productId, $quantity){
        $quantity = $quantity <= 0 ? 1 : $quantity;
        $product = Product::findOrFail($productId);
        if(Session::has('cart')){
            $currentCart = session('cart');
            if(array_has($currentCart->items, $productId)){
                $item = $currentCart->items[$productId];
                $item->quantity += $quantity;
                $currentCart->total += $product->new_price*$quantity;
            }else{
                $cart = Cart::newItems($productId, $product, $quantity);
                $currentCart->items[$productId] = $cart;
                $currentCart->total += $product->new_price*$quantity;
            }
        }else{
            $cart = Cart::newItems($productId, $product, $quantity);
            $total = $cart->quantity*$cart->product->new_price;
            $cartItem = Cart::newCart($cart, $total);
            session(['cart' => $cartItem]);
        }
        return response('',201);
    }
    /**
     * Get all item
     *
     * @return void
     */
    public static function get(){
        if(Session::has('cart')){
            return session('cart');
        }
        $cart = new Cart;
        return $cart;
    }
    /**
     * Update Cart
     *
     * @param int $carId
     * @param int $quantity
     * @return void
     */
    public static function update($cartId, $quantity){
        if(Session::has('cart')){
            if(is_numeric($cartId) && is_numeric($quantity)){
                $quantity = $quantity <= 0 ? 1 : $quantity;
                $currentCart = session('cart');
                $item = $currentCart->items[$cartId];
                $currentCart->total += $item->product->new_price*($quantity-$item->quantity);
                $item->quantity = $quantity;
                return response('',200);
            }
        }
        return response('',400);
    }

    /**
     * Remove an item in Cart
     *
     * @param int $cartId
     * @return void
     */
    public static function remove($cartId){
        if($cartId){
            if(Session::has('cart')){
                $currentCart = session('cart');
                if(array_has($currentCart->items, $cartId)){
                    $item = $currentCart->items[$cartId];
                    $currentCart->total -= $item->quantity*$item->product->new_price;
                    unset($currentCart->items[$cartId]);
                    return response('',200);
                }
            }
        }
        return response('',400);
    }
}
