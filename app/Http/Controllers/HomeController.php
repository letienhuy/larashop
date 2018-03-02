<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Slide;
class HomeController extends Controller
{
    public function index(Request $req)
    {
        $newProduct = Product::orderBy('id', 'desc')->paginate(40);
        $topProduct =  Product::orderBy('id', 'desc')->paginate(40);
        $sort = ['new' => __('product.new'), 'low' => __('product.low'), 'high' => __('product.high')];
            switch($req->sort){
                case 'new':
                    $newProduct = Product::orderBy('id', 'desc')->paginate(40);
                    break;
                case 'low':
                    $newProduct = Product::orderBy('new_price', 'asc')->paginate(40);
                    break;
                case 'high':
                    $newProduct = Product::orderBy('new_price', 'desc')->paginate(40);
                    break;
            }
        return view('home.index', [
        'req' => $req,
        'sort' => $sort,
        'slide' =>Slide::all(),
        'newProduct' => $newProduct,
        'topProduct' => $topProduct
        ]);
    }
}
