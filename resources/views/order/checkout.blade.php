@extends('master') @inject('city', 'App\City') @section('content')
<div class="container">
    <div class="row">
        <form id="checkout">
            <div class="col-md-4">
                <h1 class="title">
                    <span>@lang('order.info.custommer')</span>
                </h1>
                @if(Auth::check())
                <div class="desc form">
                    <b>Địa chỉ nhận hàng:</b>
                    {{ csrf_field() }}
                    @if(count($address) == 0)
                        <div class="alert alert-warning">Bạn chưa có địa chỉ nhận hàng mặc định, vui lòng thêm <b><a href="{{route('auth.address.list')}}">tại đây</a></b></div>
                    @else
                    @foreach($address as $addr)
                    <div class="input-group">
                        <input type="radio" name="address" value="{{$addr['id']}}" id="address" @if($addr->default) checked @endif>
                        <label for="address">
                            <b>{{$addr->fullname}}
                            <br>0{{$addr->phone}}</b>
                            <br>{{$addr->city}}
                            <br>{{$addr->district}}
                            <br>{{$addr->commune}}
                            <br>{{$addr->street}}</label>
                    </div>
                    @endforeach
                    @endif
                    <label for="note">{{__('order.note')}}</label>
                    <textarea name="note" id="note"></textarea>
                </div>
                @else
                <div class="desc form">
                    <b>
                        <a href="{{route('register')}}">@lang('auth.register')</a>
                    </b> @lang('main.or')
                    <b>
                        <a href="{{route('login')}}">{{__('auth.login')}}</a>
                    </b> @lang('order.to_continue'). @lang('order.not_register')
                    <br> {{ csrf_field() }}
                    <label for="fullname">{{__('auth.fullname')}}</label>
                    <input type="text" name="fullname" id="fullname">
                    <label for="phone">{{__('auth.phone')}}</label>
                    <input type="tel" name="phone" id="phone">
                    <label for="city">{{__('auth.city')}}</label>
                    <select name="city" id="city">
                    </select>
                    <label for="district">{{__('auth.district')}}</label>
                    <select name="district" id="district">
                    </select>
                    <label for="commune">{{__('auth.commune')}}</label>
                    <select name="commune" id="commune">
                    </select>
                    <label for="street">{{__('auth.street')}}</label>
                    <input type="text" name="street" id="street">
                    </select>
                    <label for="note">{{__('order.note')}}</label>
                    <textarea name="note" id="note"></textarea>
                </div>
                @endif
            </div>
            <div class="col-md-4">
                <h1 class="title">
                    <span>@lang('order.payment')</span>
                </h1>
                <div class="form">
                    <label for="payment">@lang('order.payment_type')</label>
                    <select name="payment" id="payment">
                        <option value="1">@lang('order.payment_cod')</option>
                        <option value="2">@lang('order.payment_online')</option>
                    </select>
                    <label for="bank">@lang('order.payment_bank')</label>
                    <select name="bank" id="bank">
                        <option value="Vietcombank">Vietcombank</option>
                        <option value="Techcombank">Techcombank</option>
                        <option value="MB">MB</option>
                        <option value="Vietinbank">Vietinbank</option>
                        <option value="Agribank">Agribank</option>
                        <option value="DongABank">DongABank</option>
                        <option value="Oceanbank">Oceanbank</option>
                        <option value="BIDV">BIDV</option>
                        <option value="SHB">SHB</option>
                        <option value="VIB">VIB</option>
                        <option value="MaritimeBank">MaritimeBank</option>
                        <option value="Eximbank">Eximbank</option>
                        <option value="ACB">ACB</option>
                        <option value="HDBank">HDBank</option>
                        <option value="NamABank">NamABank</option>
                        <option value="SaigonBank">SaigonBank</option>
                        <option value="Sacombank">Sacombank</option>
                        <option value="VietABank">VietABank</option>
                        <option value="VPBank">VPBank</option>
                        <option value="TienPhongBank">TienPhongBank</option>
                        <option value="SeaABank">SeaABank</option>
                        <option value="PGBank">PGBank</option>
                        <option value="Navibank">Navibank</option>
                        <option value="GPBank">GPBank</option>
                        <option value="BACABANK">BACABANK</option>
                        <option value="PHUONGDONG">PHUONGDONG</option>
                        <option value="ABBANK">ABBANK</option>
                        <option value="LienVietPostBank">LienVietPostBank</option>
                        <option value="BVB">BVB</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <h1 class="title">
                    <span>@lang('order.order_info')</span>
                </h1>
                <div class="form">
                    <div class="order-cart">
                        @if($cart->items)
                        <ul>
                            @foreach($cart->items as $item)
                            <li>
                                <img src="{{$item->product->image->first()->url ?? $item->product->defaultImage()}}" alt="{{$item->product->name}}">
                                <span class="items">
                                    <a href="{{route('product.detail', ['uri' => Helper::seo($item->product->name), 'id' => $item->product->id])}}">{{$item->product->name}}</a>
                                </span>
                                <span class="price">@lang('cart.quantity'): {{$item->quantity}} &times; {{$item->product->new_price}}đ</span>
                            </li>
                            @endforeach @endif
                        </ul>
                    </div>
                    <hr>
                    <span class="left">{{__('cart.subtotal')}}:</span>
                    <span class="right">{{$cart->total}}đ</span>
                    <hr class="clear">
                    <h4>
                        <span class="left">{{__('cart.total')}}:</span>
                        <span class="right">{{$cart->total}}đ</span>
                    </h4>
                    <hr class="clear">
                    <button class="btn-green">{{__('order.confirm')}}</button>
                </div>
            </div>
    </div>
</div>
@endsection