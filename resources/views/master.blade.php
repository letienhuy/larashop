<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{$description ?? ''}}">
    <meta name="keywords" content="{{$keywords ?? ''}}">
    <meta name="author" content="Huy Le Tien">
    <base href="{{url('')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/font-awesome.css')}}">
    <title>{{$title ?? ''}}</title>
    <script src="{{asset('assets/js/jquery-3.2.1.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
</head>

<body>
    <header>
        <div class="head">
            <div class="head-top fixed">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-11 col-sm-11">
                            <div class="head-top__hotline">
                                <span>
                                    <a href="tel:01203674653">Hotline: 01203674653</a>
                                </span>
                            </div>
                            <div class="head-top__nav">
                                <span>
                                    <a href="{{url('order/tracking')}}">
                                        <i class="fa fa-table"></i>@lang('order.tracking')</a>
                                </span>
                                <span>
                                    <a href="{{route('cart')}}">
                                        <i class="fa fa-shopping-cart"></i> @lang('cart.cart') ({{count($cart->items)}})</a>
                                </span>
                                <div class="head-top__nav-account dropdown" data-toggle="#account-dropdown">
                                    <button></button>
                                    @if(Auth::check())
                                        <span><i class="fa fa-user-circle"></i> {{Auth::user()->fullname}}</span>
                                        <ul class="dropdown-menu" id="account-dropdown">
                                        @if(Auth::user()->right === 1)
                                            <li><a href="{{route('admin')}}" style="font-weight: bold; color: #f00 !important;">
                                                <i class="fa fa-cogs"></i> Admin Cpanel</a></li>
                                        @endif
                                        <li><a href="{{route('auth')}}">
                                                <i class="fa fa-cog"></i> Thông tin tài khoản</a></li>
                                        <li><a href="{{route('auth.my.order')}}">
                                                <i class="fa fa-list-ul"></i> Đơn hàng của tôi</a></li>
                                        <li><a href="{{route('auth.my.rate')}}">
                                                <i class="fa fa-star-o"></i> Đánh giá của tôi</a></li>
                                        <li>
                                            <a href="{{route('logout')}}">
                                                <i class="fa fa-sign-out"></i> Đăng xuất</a>
                                        </li>
                                    @else
                                    <span><i class="fa fa-user-circle"></i>@lang('auth.account')</span>
                                    <ul class="dropdown-menu" id="account-dropdown">
                                        <li>
                                            <a href="{{route('register')}}">
                                                <i class="fa fa-user-plus"></i> @lang('auth.register')</a>
                                        </li>
                                        <li>
                                            <a href="{{route('login')}}">
                                                <i class="fa fa-user"></i> @lang('auth.login')</a>
                                        </li>
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <div class="cart fixed">
                                <div id="open-cart">
                                    <span class="number">{{count($cart->items) > 99 ? '99+' : count($cart->items)}}</span>
                                </div>
                                <div class="cart-menu">
                                    @if($cart->items)
                                    <ul>
                                        @foreach($cart->items as $item)
                                        <li>
                                            <img src="{{$item->product->image->first()->url ?? $item->product->defaultImage()}}" alt="{{$item->product->name}}">
                                            <span>
                                                <a href="{{route('product.detail', ['uri' => Helper::seo($item->product->name), 'id' => $item->product->id])}}">{{$item->product->name}}</a>
                                            </span>
                                            <span class="price">@lang('cart.quantity'): {{$item->quantity}} &times; {{$item->product->new_price}}đ</span>
                                            <button class="closex" onclick="removeItem({{$item->cartId}})">&times;</button>
                                        </li>
                                        @if($loop->index >= 4)
                                        <center>
                                            <a href="{{route('cart')}}">
                                                <button class="btn btn-primary">@lang('cart.viewmore')...</button>
                                            </a>
                                        </center>
                                        @endif @endforeach
                                    </ul>
                                    <div class="total">
                                        <span>@lang('cart.total'): {{$cart->total}}đ</span>
                                        <a href="{{url('order/checkout')}}">
                                            <button>@lang('cart.paynow')</button>
                                        </a>
                                    </div>
                                    @else
                                    <center>
                                        @lang('cart.empty')
                                    </center>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="head-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="logo">
                                <a href="{{route('home')}}">
                                    <img src="{{asset('assets/images/logo-dan.png')}}" alt="LOGO">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-12 hidden-xs">
                            <div class="sale-pocily visible-lg">
                                <ul>
                                    <li>
                                        <i class="fa fa-truck"></i>
                                        Giao hàng toàn quốc
                                        <li>
                                            <i class="fa fa-money"></i>
                                            Thanh toán tại nhà
                                            <li>
                                                <i class="fa fa-exchange"></i>
                                                Trả hàng trong 7 ngày
                                            </li>
                                </ul>
                            </div>
                            <div class="search">
                                <form action="{{route('search')}}">
                                    <div class="search-box">
                                        <input type="text" name="k" placeholder="Tìm kiếm...">
                                        <div class="select-box">
                                            <select name="cat">
                                                <option value="">Tất cả</option>
                                                @foreach($category as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                @foreach($cat->child as $childCat)
                                                <option value="{{$childCat->id}}">{{$childCat->name}}</option>
                                                @endforeach @endforeach
                                            </select>
                                        </div>
                                        <button id="search">
                                            TÌM
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-menu">
            <div class="container">
                <button>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul>
                    <li class="dropdown hidden-xs" data-toggle="#dropdown-menu">
                        Danh sách danh mục
                        <ul class="dropdown-menu" id="dropdown-menu">
                            @foreach($category as $cat)
                            <li>
                                <a style="font-weight:bold;" href="{{route('category.detail', ['uri' => Helper::seo($cat->name), 'id' => $cat->id])}}">{{$cat->name}}</a>
                            </li>
                            @foreach($cat->child as $childCat)
                            <li style="margin-left:15px;">
                                <a href="{{route('category.detail', ['uri' => Helper::seo($childCat->name), 'id' => $childCat->id])}}">{{$childCat->name}}</a>
                            </li>
                            @endforeach @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('product')}}">{{__('product.product')}}</a>
                    </li>
                    <li>
                        <a href="{{route('promotion')}}">Khuyến mãi</a>
                    </li>
                    <li>
                        <a href="{{route('about.us')}}">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="{{route('transport.policy')}}">Chính sách vận chuyển & đổi trả</a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div id="content">
        @yield('content')
    </div>
    <div id="up-top"></div>
    <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5">
                        <b>
                        Địa Chỉ: Văn Trì, Phường Minh Khai, Quận Bắc Từ Liên, TP.Hà Nội<br>
                        Email hỗ trợ: support.rentacc@gmail.com<br>
                        Hotline: 1234.567.890
                        </b>
                    </div>
                </div>
            </div>
        </footer>
    <script src="{{asset('assets/js/site.js')}}"></script>
</body>

</html>