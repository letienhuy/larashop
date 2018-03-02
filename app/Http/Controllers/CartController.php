<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
class CartController extends Controller
{
    //
    public function index(){
        $topProduct = Product::where('top', 1)->inRandomOrder()->limit(4)->get();
        return view('cart.index', ['cart' => Cart::get(), 'topProduct' => $topProduct]);
    }
}
