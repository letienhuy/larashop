<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
Route::group(['prefix' => 'cart'], function(){
    Route::get('/', [
        'as' => 'cart',
        'uses' => 'CartController@index'
    ]);
    Route::get('items/add/{productId}/{quantity?}', function(Request $req, $productId, $quantity = 1){
        if($req->ajax())
            return App\Cart::add($productId, $quantity);
    });
    Route::get('items/remove/{cartId}', function(Request $req, $cartId){
        if($req->ajax())
            return App\Cart::remove($cartId);
    });
    Route::get('items/update/{cartId}/{quantity?}', function(Request $req, $cartId, $quantity = 1){
        if($req->ajax())
            return App\Cart::update($cartId, $quantity);
    });
});


Route::group(['prefix' => 'product'], function(){
    Route::get('/', 'ProductController@index')->name('product');

    Route::get('{uri}_{id}.html', 'ProductController@product')->name('product.detail');
    
    Route::get('{uri}.{id}.html', 'ProductController@category')->name('category.detail');

    Route::post('{productId}/comments/add', 'CommentController@addComment');

    Route::post('{productId}/comments/{commentId}/replies/add', 'CommentController@addComment');

    Route::get('{product_id}/comments/{skip?}/{take?}', 'CommentController@getComment');

    Route::get('{product_id}/rates/{skip?}/{take?}', 'CommentController@getRate');
});

Route::group(['prefix' => 'comment'], function(){
    Route::get('{comment_id}/replies/{skip?}/{take?}', 'CommentController@getReply');

    Route::get('{comment_id}/remove', 'CommentController@removeComment');

    Route::post('{comment_id}/edit', 'CommentController@editComment');
});

Auth::routes();

Route::middleware('auth')->prefix('auth')->group(function(){
    Route::get('/', 'Auth\AuthController@index')->name('auth');
    Route::match(['get', 'post'], 'edit-info', 'Auth\AuthController@edit')->name('auth.edit.info');
    Route::get('my-order', 'Auth\AuthController@myOrder')->name('auth.my.order');
    Route::get('my-rate', 'Auth\AuthController@myRate')->name('auth.my.rate');
    Route::get('link-social', 'Auth\AuthController@index')->name('auth.link.social');
    Route::match(['GET', 'POST'], 'edit-password', 'Auth\AuthController@edit_password')->name('auth.edit.password');
    Route::any('address-list/{action?}', 'Auth\AuthController@addressList')->name('auth.address.list');
});
Route::group(['prefix' => 'order'], function(){
    Route::get('checkout', 'OrderController@checkout');
    Route::post('confirm', 'OrderController@confirm');
    Route::any('tracking', 'OrderController@tracking')->name('order.tracking');
    Route::get('order-tracking/{orderId}', 'OrderController@order_tracking')->name('order.order_tracking');
});

Route::middleware('admin')->prefix('admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin');    
    Route::match(['GET', 'POST'],'/product/{action?}', 'AdminController@product')->name('admin.product');    
    Route::get('/order/{action?}', 'AdminController@order')->name('admin.order');    
    Route::get('/user/{action?}', 'AdminController@user')->name('admin.user');    
    Route::any('/category/{action?}', 'AdminController@category')->name('admin.category');    
    Route::any('/slide/{action?}', 'AdminController@slide')->name('admin.slide');    
    Route::get('/setting=', 'AdminController@setting')->name('admin.setting');    
});

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

Route::get('search', [
    'as' => 'search',
    'uses' => 'SearchController@index'
]);
Route::get('promotion', [
    'as' => 'promotion',
    'uses' => 'HomeController@index'
]);
Route::get('transport-policy', [
    'as' => 'transport.policy',
    'uses' => 'HomeController@index'
]);
Route::get('about-us', [
    'as' => 'about.us',
    'uses' => 'HomeController@index'
]);
Route::get('contact', [
    'as' => 'contact',
    'uses' => 'HomeController@index'
]);
