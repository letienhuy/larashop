<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use App\Image;
use App\Rate;
use App\Category;
use App\Comment;
use App\User;
use App\Slide;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
    //
    public function index(){
        $unApproved = Order::where('status', '-1')->get();
        $order = Order::orderBy('status', 'desc')->paginate(10);
        return view('admin.index', ['unApproved' => $unApproved, 'order' => $order]);
    }
    public function product(Request $request, $action = null){
        switch($action){
            case 'new':
                if($request->method() == "POST"){
                    $request->validate([
                        'name' => 'required',
                        'desc' => 'required',
                        'sort_desc' => 'required|max:160',
                        'price' => 'required|integer',
                        'sale' => 'required|integer|max:99',
                        'catId' => 'required|integer',
                    ]);
                    $category = \App\Category::findOrFail($request->catId);
                    if(isset($request->id)){
                        $product = Product::findOrFail($request->id);
                    }else{
                        $product = new Product;
                    }
                    $product->name = $request->name;
                    $product->sort_desc = $request->sort_desc;
                    $product->description = $request->desc;
                    $product->price = $request->price;
                    $product->sale = $request->sale;
                    $product->new_price = $request->price*(100-$request->sale)/100;
                    $product->cat_id = $request->catId;
                    $product->keywords = $request->keyword;
                    $product->top = $request->top ? 1 : 0;
                    $product->save();
                    $productPath = public_path('upload/product/'.$product->id);
                    if(!is_null(session('image'))){
                    if(!is_dir(public_path('upload/product/')))
                        mkdir(public_path('upload/product/'));
                    if(!is_dir($productPath))
                        mkdir($productPath);
                    foreach(session('image') as $key => $val){
                        if(file_exists(public_path('upload/tmp/'.$key))){
                            if(copy(public_path('upload/tmp/'.$key), public_path('upload/product/'.$product->id.'/'.$key))){
                                $img = new Image;
                                $img->url = url('upload/product/'.$product->id.'/'.$key);
                                $img->product_id = $product->id;
                                $img->save();
                                unlink(public_path('upload/tmp/'.$key));
                            }
                        }
                    }}
                    session()->forget('image');
                    return redirect()->route('admin.product');
                }
                return view('admin.product_new');
            break;
            case 'edit':
                $product = Product::findOrFail($request->id);
                $image = array();
                foreach($product->image as $img){
                    $key = explode('/', $img->url);
                    $key = array_pop($key);
                    $image[$key] = $img->url;
                }
                session(['image' => $image]);
                return view('admin.product_edit', ['product' => $product]);
            break;
            case 'getImage':
                return view('admin.product_image', ['image' => session('image')]);
            break;
            case 'deleteImage':
                if(session()->has('image')){
                    $image = session('image');
                    unset($image[$request->image]);
                    session(['image' => $image]);
                    if(file_exists(public_path('upload/tmp/'.$request->image))){
                        unlink(public_path('upload/tmp/'.$request->image));
                    }elseif(file_exists(public_path('upload/product/'.$request->id.'/'.$request->image))){
                        unlink(public_path('upload/product/'.$request->id.'/'.$request->image));
                        Image::where('url', url('upload/product/'.$request->id.'/'.$request->image))->delete();
                    }
                }
            break;
            case 'image':
                $path = "";
                $request->validate([
                    'image' => 'image'
                ]);
                if($request->hasFile('image')){
                    $tmpName = md5(time()).'.'.$request->image->getClientOriginalExtension();
                    $path = $request->image->move('upload/tmp/', $tmpName);
                    if(session()->has('image')){
                        $image = session('image');
                        $image[$tmpName] = url($path);
                        session(['image' => $image]);
                    }else{
                        $image = array();
                        $image[$tmpName] = url($path);
                        session(['image' => $image]);
                    }
                }
            break;
            case 'delete':
            $product = Product::findOrFail($request->id);
            if($request->confirm){
                $image = Image::where('product_id', $request->id)->get();
                foreach($image as $img){
                    $fileName = explode('/', $img->url);
                    $fileName = end($fileName);
                    if(file_exists(public_path('upload/product/'.$request->id.'/'.$fileName))){
                        unlink(public_path('upload/product/'.$request->id.'/'.$fileName));
                    }
                    $img->delete();
                }
                Rate::where('product_id', $request->id)->delete(); 
                Comment::where('product_id', $request->id)->delete(); 
                $product->delete();
                return redirect()->route('admin.product');
            }
            break;
            case 'multiDelete':
                foreach($request->product_id as $id){
                    $product = Product::findOrFail($id);
                    $image = Image::where('product_id', $id)->get();
                    foreach($image as $img){
                        $fileName = explode('/', $img->url);
                        $fileName = end($fileName);
                        if(file_exists(public_path('upload/product/'.$id.'/'.$fileName))){
                            unlink(public_path('upload/product/'.$id.'/'.$fileName));
                        }
                        $img->delete();
                    }
                    Rate::where('product_id', $id)->delete(); 
                    Comment::where('product_id', $id)->delete(); 
                    $product->delete();
                }
            break;
            case 'multiMove':
                if(!$request->catId){
                    session(['product_id'=>$request->product_id]);
                    $product_id = session('product_id');
                    return view('admin.product_move', ['product_id' => $product_id]);
                }else{
                    foreach(session('product_id') as $id){
                        $product = Product::findOrFail($id);
                        $product->cat_id = $request->catId;
                        $product->save();
                        session()->forget('product_id');
                        return redirect()->route('admin.product');
                    }
                }
            break;
            default:
            if(isset($request->catId)){
                $product = Product::where('cat_id', $request->catId)->orderBy('id', 'desc')->paginate(20);
            }else{
                $product = Product::orderBy('id', 'desc')->paginate(20);
            }
            return view('admin.product', ['product' => $product]);
            break;
        }
    }
    public function order(Request $request, $action = null){
        switch($action){
            case 'approve':
                $order = Order::findOrFail($request->id);
                $order->status = 0;
                $order->save();
                return redirect()->route('admin.order');
            break;
            case 'close':
                $order = Order::findOrFail($request->id);
                $order->payment->status = 1;
                $order->payment->save();
                $order->status = 1;
                $order->save();
                return redirect()->route('admin.order');
            break;
            default:
            if(isset($request->filters)){
                switch($request->filters){
                    case 'success':
                        $order = Order::where('status', '1')->orderBy('id', 'desc')->paginate(20);
                    break;
                    case 'unapproved':
                        $order = Order::where('status', '-1')->orderBy('id', 'desc')->paginate(20);
                    break;
                    case 'approved':
                        $order = Order::where('status', '0')->orderBy('id', 'desc')->paginate(20);
                    break;
                    default:
                        $order = Order::orderBy('status', 'desc')->paginate(20);
                    break;
                }
            }else{
            $order = Order::orderBy('status', 'desc')->paginate(20);
            }
            return view('admin.order', ['order' => $order]);
            break;
        }
    }
    public function user(Request $request, $action = null){
        switch($action){
            case 'right':
                if($request->type == "up"){
                    $user = User::findOrFail($request->id);
                    $user->right = 1;
                    $user->save();                    
                }elseif($request->type == "down"){
                    $user = User::findOrFail($request->id);
                    $user->right = 0;
                    $user->save();   
                }
                return redirect()->route('admin.user');
                break;
            case 'delete':
                if($request->confirm){
                    User::findOrFail($request->id)->delete();
                    return redirect()->route('admin.user');
                }
            break;
            default:
                $user = User::where('id', '!=', \Auth::id())->paginate(20);
                return view('admin.user', ['user' => $user]);
            break;
        }
    }
    public function category(Request $request, $action = null){
        switch($action){
            case 'new':
                if($request->method() == "POST"){
                    $request->validate([
                        'name' => 'required',
                        'desc' => 'required'
                    ]);
                    $category = new Category;
                    $category->name = $request->name;
                    $category->description = $request->desc;
                    $category->parent_id = $request->catId;
                    $category->save();
                    return redirect()->route('admin.category');
                }
                return view('admin.category_new');
            break;
            case 'edit':
                $category = Category::findOrFail($request->id);
                if($request->method() == "POST"){
                    $request->validate([
                        'name' => 'required',
                        'desc' => 'required'
                    ]);
                    $category = Category::findOrFail($request->id);
                    $category->name = $request->name;
                    $category->description = $request->desc;
                    $category->parent_id = $request->catId ?? 0;
                    $category->save();
                    return redirect()->route('admin.category');
                }
            return view('admin.category_edit', ['category' => $category]);
            break;
            case 'delete':
                if($request->confirm){
                    $category = Category::findOrFail($request->id);
                    if(count($category->product) > 0){
                        return redirect()->back()->withErrors(['error' => 'Danh mục đang có sản phẩm, không thể xoá!']);
                    }elseif(count($category->child) > 0){
                        return redirect()->back()->withErrors(['error' => 'Danh mục đang có danh mục con, không thể xoá!']);
                    }else{
                        $category->delete();
                        return redirect()->back();                        
                    }
                }
            break;
            default:
                $category = Category::orderBy('parent_id', 'asc')->paginate(20);
                return view('admin.category', ['category' => $category]);
            break;
        }
    }
    public function slide(Request $request, $action = null){
        switch($action){
            case 'new':
            if($request->method() == "POST"){
                if($request->hasFile('image'))
                {
                    foreach($request->image as $file){
                        $fileName = md5(time()).'.'.$file->extension();
                        $file->move(public_path('upload/slide/'), $fileName);
                        $slide = new Slide;
                        $slide->url = url('upload/slide/'.$fileName);
                        $slide->save();
                    }
                //$base64 = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode($file);
                    return redirect()->route('admin.slide');
                }elseif(isset($request->url)){
                    $slide = new Slide;
                    $slide->url = $request->url;
                    $slide->save();
                    return redirect()->route('admin.slide');
                }
            }
            
                return view('admin.slide_new');
            break;
            case 'delete':
                if($request->confirm){
                    $slide = Slide::findOrFail($request->id);
                    $fileName = explode('/', $slide->url);
                    $fileName = end($fileName);
                    if(file_exists(public_path('upload/slide/'.$fileName))){
                        unlink(public_path('upload/slide/'.$fileName));
                    }
                    $slide->delete();
                    return redirect()->route('admin.slide');
                }
            break;
            default:
                $slide = Slide::paginate(20);
                return view('admin.slide', ['slide' => $slide]);
            break;
        }
    }
}
