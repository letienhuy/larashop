@extends('master')
@section('content')
<div id="content">
    <div class="container">
        @if(count($slide) > 0)
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                <div class="ads">
                    <img src="{{$slide->random(1)[0]->url}}">
                </div>
            </div>
            <div class="col-md-8 col-lg-8 col-sm-6 col-xs-12">
                <div class="slide">
                    <ul>
                        @foreach($slide as $item)
                            <li>
                                <img src="{{$item->url}}"/>
                            </li>
                        @endforeach
                    </ul>
                    <div class="slide-gallery">
                    @foreach($slide as $item)
                        <span class="slide-gallery-dot"></span>
                    @endforeach
                    </div>
                    <div class="prev"></div>
                    <div class="next"></div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="container">
        <h1 class="title">
            <span>Sản phẩm mới</span>
        </h1>
        <div class="desc">
            <span class="left">Tìm thấy <b> {{count($newProduct)}}</b> sản phẩm</span>
            <span class="right">
                <form id="new">
                Sắp xếp theo:
                    <select name="sort" onchange="submitForm('new')">
                        @foreach($sort as $key => $val)
                            <option value="{{$key}}"
                            @if($req->by == 'new' && $req->sort == $key)
                                selected
                            @endif
                            >{{$val}}</option>
                        @endforeach
                    </select>
                </form>
            </span>
        </div>
        <div class="row clear">
        @foreach($newProduct as $p)
            <div class="col-md-2 col-sm-3 col-xs-6">
                <div class="product">
                    <a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}" title="{{$p->name}}">
                    <div class="thumb" style="background-image: url({{ $p->image->first()->url ?? $p->defaultImage()}});"></div>
                    </a>
                    @if($p->sale)
                        <div class="sale">-{{$p->sale}}%</div>
                    @endif
                    <div class="product-name"><a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}" title="{{$p->name}}">{{$p->name}}</a></div>
                    <div class="product-price">{{$p->new_price}}đ <span class="pre">{{$p->price}}đ</span></div>
                    <div class="product-action">
                        <button id="buy" onclick="addItem({{$p->id}})">@lang('product.buynow')</button>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <center>{{$newProduct->appends($req->all())->links()}}</center>
        <h1 class="title">
            <span>Sản phẩm đang hot</span>
        </h1>
        <div class="row">
        @foreach($topProduct as $p)
            <div class="col-md-2 col-sm-3 col-xs-6">
                <div class="product">
                    <a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}" title="{{$p->name}}">
                    <div class="thumb" style="background-image: url({{ $p->image->first()->url ?? $p->defaultImage() }});"></div>
                    </a>
                    @if($p->sale)
                        <div class="sale">-{{$p->sale}}%</div>
                    @endif
                    <div class="product-name"><a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}" title="{{$p->name}}">{{$p->name}}</a></div>
                    <div class="product-price">{{$p->new_price}}đ <span class="pre">{{$p->price}}đ</span></div>
                    <div class="product-action">
                        <button id="buy" onclick="addItem({{$p->id}})">@lang('product.buynow')</button>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
  </div>
</div>
@endsection