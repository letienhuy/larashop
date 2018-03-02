<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class SearchController extends Controller
{
    //
    public function index(Request $req){
        $key = [['name', 'like', '%'.$req->k.'%']];
        if(isset($req->cat)){
            $key[] = ['cat_id', $req->cat];
        }
        if(isset($req->priceFrom) && isset($req->priceTo)){
            $key[] = ['price', '>=', $req->priceFrom];
            $key[] = ['price', '<=', $req->priceTo];
        }
        $result = Product::where($key)->paginate(12);
        return view('search.index', [
            'req' => $req,
            'result' => $result
        ]);
    }
}
