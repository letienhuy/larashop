<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Comment;
class ProductController extends Controller
{
    /**
     * List product
     *
     * @param Request $req
     * @return view
     */
    public function index(Request $req){
        $products = Product::orderBy('id', 'desc')->paginate(12);
        switch($req->sort){
            case 'new':
                $products = Product::orderBy('id', 'desc')->paginate(12);
                break;
            case 'low':
                $products = Product::orderBy('new_price', 'asc')->paginate(12);
                break;
            case 'high':
                $products = Product::orderBy('new_price', 'desc')->paginate(12);
                break;
        }
        $sort = ['new' => __('product.new'), 'low' => __('product.low'), 'high' => __('product.high')];
        return view('product.index', [
            'req' => $req,
            'sort' => $sort,
            'products' => $products
        ]);
    }
    /**
     * Product detail
     *
     * @param string $uri
     * @param int $id is productId
     * @return view
     */
    public function product($uri, $id){
        if(is_null($id) || !is_numeric($id))
            abort(404);
        $product = Product::findOrFail($id);
        $breadcrum = ['links' => []];
        $category = $product->category;
        if($category->parent_id != 0){
            $parent = Category::find($category->parent_id);
            $breadcrum['links'] = [$parent->name => route('category.detail', ['uri' => \Helper::seo($parent->name), 'id' => $parent->id])];
        }
        $breadcrum['links'] += [$category->name => route('category.detail', ['uri' => \Helper::seo($category->name), 'id' => $category->id])];
        $breadcrum['links'] += [$product->name => ''];
        $related = Product::where([['id', '!=', $id], 'cat_id' => $category->id])->inRandomOrder()->take(6)->get();
        return view('product.product', [
            'product' => $product,
            'related' => $related,
            'breadcrum' => $breadcrum
        ]);
        
    }
    /**
     * List product of category
     *
     * @param Request $req
     * @param string $uri
     * @param int $id is categoryId
     * @return view
     */
    public function category(Request $req, $uri, $id){
        $category = Category::findOrFail($id);
        if(is_null($id) || !is_numeric($id))
            abort(404);
            $products = Product::where('cat_id', $id)->orderBy('id', 'desc')->paginate(12);
            switch($req->sort){
                case 'new':
                    $products = Product::where('cat_id', $id)->orderBy('id', 'desc')->paginate(12);
                    break;
                case 'low':
                    $products = Product::where('cat_id', $id)->orderBy('new_price', 'asc')->paginate(12);
                    break;
                case 'high':
                    $products = Product::where('cat_id', $id)->orderBy('new_price', 'desc')->paginate(12);
                    break;
            }
            $sort = ['new' => __('product.new'), 'low' => __('product.low'), 'high' => __('product.high')];
            return view('product.category', [
                'req' => $req,
                'sort' => $sort,
                'products' => $products,
                'category' => $category
            ]);
    }
}
