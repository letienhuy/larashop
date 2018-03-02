@extends('master', ['title' => $product->name, 'description' => $product->sort_desc, 'keywords' => $product->keywords])
@section('content')
<div class="container">
    <div class="row">
        @include('_breadcrum', $breadcrum)
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-5">
                    <div class="slide">
                        <ul>
                            @if(count($product->image) == 0)
                            <li>
                                <img src="{{$product->defaultImage()}}">
                            </li>
                            @else
                                @foreach($product->image as $item)
                                <li class="zoom">
                                    <img src="{{$item->url}}">
                                </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="slide-gallery">
                            @foreach($product->image as $item)
                            <span class="slide-gallery-dot"></span>
                            @endforeach
                        </div>
                        <div class="small-image">
                            <ul>
                                @if(count($product->image) == 0)
                                <li>
                                    <img src="{{$product->defaultImage()}}" alt="{{$product->name}}">
                                </li>
                                @else @foreach($product->image as $item)
                                <li>
                                    <img src="{{$item->url}}" alt="{{$product->name}}">
                                </li>
                                @endforeach @endif
                            </ul>
                        </div>
                        <div class="prev"></div>
                        <div class="next"></div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="product-page">
                        <h1 class="product-title">{{$product->name}}</h1>
                        {!! Helper::getStatus($product->status) !!}
                        <div class="product-price">{{$product->new_price}}đ
                            <span class="pre">{{$product->price}}đ</span>
                        </div>
                        @if($product->sale > 0)
                        <div class="product-sale">@lang('product.sale'):
                            <b style="color:red">-{{$product->sale}}%</b>
                        </div>
                        @endif
                        <div class="product-sort-desc">{{$product->sort_desc}}</div>
                        <div class="product-quantity">
                            @lang('product.quantity'):
                            <input type="number" name="quantity" id="quantity" value="1" min="1">
                        </div>
                        <button {{$product->status != 1 ? 'disabled="true"': ''}} class="btn-red" onclick="addItem({{$product->id}}, document.getElementById('quantity').value)">@lang('product.buynow')</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product-tab-container">
                    <ul class="product-tab-container__header">
                    <li class="active">@lang('product.info')</li>
                    <li>@lang('product.rate') ({{count($product->rate)}})</li>
                    <li>@lang('product.comment') ({{count($product->comment)}})</li>
                    </ul>
                    <div class="product-tab-container__content">
                        <div class="product-tab-description" style="display: block;">
                            <div class="product-tab-description__content">
                                {!! $product->description !!}
                            </div>
                            <div class="product-tab-description__footer">
                            @if(count($product->keywords()) > 0)
                                <div class="__keyword">@lang('product.keywords'): 
                                @foreach($product->keywords() as $item)
                                    <a href="{{route('search',['k' => $item])}}">{{$item}}</a>,
                                @endforeach
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="product-tab-rate" data-id="{{$product->id}}">
                            @if(count($product->rate) == 0)
                            <div class="product-tab-rate__info">
                                Chưa có đánh giá cho sản phẩm này!
                            </div>
                            @endif
                                <div id="product-tab-rate">
                                </div>
                            @if(count($product->rate) > 10)
                            <div id="load-more-rate" data-total="{{count($product->rate)-10}}"><button>Xem thêm {{count($product->rate)-10}} đánh giá...</button></div>
                            @endif
                        </div>
                        <div class="product-tab-comment" data-id="{{$product->id}}">
                        @if(count($product->comment) == 0)
                        <div class="product-tab-comment__info">
                            Chưa có bình luận cho sản phẩm này!
                        </div>
                        @endif
                            <div id="product-tab-comment">
                            </div>
                        @if(count($product->comment) > 5)
                        <div id="load-more-comment" data-total="{{count($product->comment)-5}}"><button>Xem thêm {{count($product->comment)-5}} bình luận...</button></div>
                        @endif
                        @auth
                        <form id="form-comment" data-id="{{$product->id}}">
                            {{ csrf_field() }}
                            <textarea name="comment"></textarea>
                            <span class="validation"></span>
                            <input type="submit" class="btn-green" value="Bình luận">
                        </form>
                        @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product-side">
                <div class="side-title">CHÍNH SÁCH BÁN HÀNG</div>
                <ul>
                    <li>Giao hàng toàn quốc</li>
                    <li>Thanh toán khi nhận hàng</li>
                    <li>Đổi trả trong vòng 7 ngày</li>
                    <li>
                        <b style="color:red">Freeship</b> cho đơn hàng từ
                        <b style="color:red">180K</b> trở lên</li>
                </ul>
            </div>
            <div class="product-side">
                <div class="side-title">HƯỚNG DẪN MUA HÀNG</div>
                <ul>
                    <li>Mua trực tiếp tại website</li>
                    <li>Đặt hàng qua hotline: <b style="color:red">01234567890</b></li>
                    <li>Mua trực tiếp tại cửa hàng:
                        <b style="color:red">Địa chỉ here</b>
                    </li>
                </ul>
            </div>
            <div class="product-side">
                <div class="side-title">SẢN PHẨM CÙNG CHUYÊN MỤC</div>
                <div class="row">
                    @foreach($related as $p)
                    <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="product">
                    <a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}" title="{{$p->name}}">
                    <div class="thumb" style="background-image: url({{ $p->image->first()->url ?? $p->defaultImage() }});"></div>
                    </a>
                    @if($p->sale)
                        <div class="sale">-{{$p->sale}}%</div>
                    @endif
                    <div class="product-name"><a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}" title="{{$p->name}}">{{$p->name}}</a></div>
                    <div class="product-price">{{$p->new_price}} VND <span class="pre">{{$p->price}} VND</span></div>
                    <div class="product-action">
                        <button id="buy" onclick="addItem({{$p->id}})">@lang('product.buynow')</button>
                    </div>
                    </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/product.js')}}"></script>
@endsection