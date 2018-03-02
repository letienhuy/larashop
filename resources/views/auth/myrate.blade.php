@extends('master', ['title' => 'Đánh giá của tôi'])
@section('content')
    <h1 class="title"><span>ĐÁNH GIÁ CỦA TÔI</span></h1>
    <div class="container">
        <div class="row desc">
            @if(count($rate) != 0)
            <table class="table table-striped">
            <tr>
                <th>Sản phẩm</th>
                <th>Comment</th>
                <th>Sao</th>
                <th>Thời gian</th>
            </tr>
            @foreach($rate as $item)
                <tr>
                    <td><a href="{{route('product.detail', ['uri' => Helper::seo( $item->product->name) , 'id' => $item->product->id])}}">{{$item->product->name}}</a></td>
                    <td>{{$item->comment}}</td>
                    <td>{{$item->star}}</td>
                    <td>{{date('d-m-Y H:m', strtotime($item->created_at))}}</td>
                </tr>
            @endforeach
            </table>
            <center>{{$rate->links()}}</center>
            @else
            <div class="desc">
                <center>Bạn chưa đánh giá đơn hàng nào!</center>
            </div>
            @endif
        </div>
    </div>
@endsection