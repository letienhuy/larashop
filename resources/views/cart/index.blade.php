@extends('master',['title' => __('cart.cart')])
@section('content')
    <div class="container">
        @include('_breadcrum', ['links' => [__('cart.cart') => route('cart')]])
        <div class="row">
            <h4>{{__('cart.cart')}}</h4>
            <div class="cart-page">
                @if(count($cart->items) == 0)
                    <div class="desc">
                        <center>
                            {{__('cart.cart_empty')}}. <a href="{{route('product')}}">{{__('cart.cart_continue')}}!</a>
                        </center>
                    </div>
                        @if($topProduct)
                            <h1 class="title">
                            <span>@lang('cart.tip')</span>
                            </h1>
                        @endif
                        @foreach($topProduct as $p)
                            <div class="col-md-2 col-sm-3 col-xs-6">
                            <div class="product">
                            <a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}">
                            <div class="thumb" style="background-image: url({{ $p->image->first()->url ?? $p->defaultImage() }});"></div>
                            </a>
                            @if($p->sale)
                                <div class="sale">-{{$p->sale}}%</div>
                            @endif
                            <div class="product-name"><a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}">{{$p->name}}</a></div>
                            <div class="product-price">{{$p->new_price}}đ <span class="pre">{{$p->price}}đ</span></div>
                            <div class="product-action">
                                <button id="buy" onclick="addItem({{$p->id}})">@lang('product.buynow')</button>
                            </div>
                        </div>
                        </div>
                        @endforeach
                @else
                    <div class="col-md-8 col-sm-6">
                        <table>
                            <tr>
                                <th class="w10">{{count($cart->items)}} {{Helper::langUpper('product.product')}}</th>
                                <th class="w50"></th>
                                <th class="w20">{{Helper::langUpper('product.price')}}</th>
                                <th class="w20">{{Helper::langUpper('product.quantity')}}</th>
                            </tr>
                        </table>
                        @foreach($cart->items as $item)
                            <table class="cart-product" cellpadding="20">
                                <tr>
                                    <td class="w10">
                                        <img src="{{$item->product->image->first()->url ?? $item->product->defaultImage()}}" alt="{{$item->product->name}}">
                                    </td>
                                    <td class="cart-product-name w50" style="text-align: left;">
                                        <a href="{{route('product.detail', ['uri' => Helper::seo($item->product->name), 'id' => $item->product->id])}}">{{$item->product->name}}</a>
                                    </td>
                                    <td class="w20">
                                        {{$item->product->new_price}}đ
                                    </td>
                                    <td class="w20">
                                        <div class="quantum">
                                            <button class="up" id="up-{{$item->product->id}}" onclick="up(this.id)">
                                                +
                                            </button>
                                            <input type="number"
                                                   onchange="updateItem({{$item->product->id}}, this.value)"
                                                   value="{{$item->quantity}}">
                                            <button class="down" id="down-{{$item->product->id}}"
                                                    onclick="down(this.id)">-
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <button onclick="removeItem({{$item->product->id}})">&times;</button>
                                    </td>
                                </tr>
                            </table>
                        @endforeach
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <h4>{{__('cart.info')}}</h4>
                        <hr>
                        <span class="left">{{__('cart.subtotal')}}:</span>
                        <span class="right">{{$cart->total}}đ</span>
                        <hr class="clear">
                        <h4>
                            <span class="left">{{__('cart.total')}}:</span>
                            <span class="right">{{$cart->total}}đ</span>
                        </h4>
                        <hr class="clear">
                        <form action="{{url('order/checkout')}}">
                        <button class="btn-red" style="width: 100%;">{{Helper::langUpper('cart.paynow')}}</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection