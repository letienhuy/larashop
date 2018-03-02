@extends('master', ['title' => $category->name.' - Toàn bộ sản phẩm'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-5">
            <div id="show-cat">{{Helper::langUpper('product.category')}}</div>
            <ul class="category">
                {!! Helper::category() !!}
            </ul>
        </div>
        <div class="col-md-8 col-sm-7">
        @include('_breadcrum', ['links' => [__('product.product') => route('product'), $category->name => route('product')]])
            <div class="desc">
                <span class="left">@lang('product.found', ['num' => count($products)])</span>
                <span class="right">
                    <form id="sort">
                        @lang('product.sort')
                        <select name="sort" onchange="submitForm('sort');">
                            @foreach($sort as $key => $val)
                            <option value="{{$key}}" @if($req->sort == $key) selected @endif >{{$val}}
                            </option>
                            @endforeach
                        </select>
                    </form>
                </span>
            </div>
            <div class="row">
                @foreach($products as $p)
                    <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="product">
                    <a href="{{route('product.detail', ['uri' => Helper::seo($p->name), 'id' => $p->id])}}" title="{{$p->name}}">
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
            </div>
            <center>{{$products->appends($req->all())->links()}}</center>
        </div>
    </div>
</div>
@endsection