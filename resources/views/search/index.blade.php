@extends('master', ['title' => 'Tìm kiếm'.' - '.($req->k ?? 'sản phẩm')])
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
            @include('_breadcrum', ['links' => [__('messages.search') => route('search'), $req->k ?? __('messages.no_keywords') => route('search', ['k' => $req->k])]])
            @inject('category', 'App\Category')
            <div class="form-group">
            <form action="{{route('search')}}" class="form">
            <input type="text" name="k">
            @lang('messages.search_in'):
            <select name="cat" id="">
                <option value="">{{__('main.all')}}</option>
                @foreach($category->all() as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            @lang('product.price'):<input type="number" name="priceFrom" value="0" class="w20 inline">
            @lang('main.to') <input type="number" name="priceTo" value="99000" class="w20 inline">
            <button class="btn-green">@lang('messages.search')</button>
            </form>
            </div>
        @if(isset($result))
            <div class="desc">
                <span class="left">{!! __('product.found', ['num' => count($result)]) !!}</span>
            </div>
            <div class="row">
                @foreach($result as $p)
                    <div class="col-md-4 col-sm-6 col-xs-6">
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
            </div>
            <center>{{$result->appends($req->all())->links()}}</center>
        </div>
        @endif
    </div>
</div>
@endsection