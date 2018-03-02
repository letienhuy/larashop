@extends('master', ['title' => 'Đơn hàng của tôi'])
@section('content')
    <div class="container">
        <div class="row desc">
            @if(count($order) != 0)
            <table class="table table-striped">
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày tạo</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
            </tr>
            @foreach($order as $item)
                <tr>
                    <td><a href="{{route('order.order_tracking', ['orderId' => $item->order_code])}}">{{$item->order_code}}</a></td>
                    <td>{{date('d-m-Y H:m', strtotime($item->created_at))}}</td>
                    <td>{{$item->total}}đ</td>
                    <td>
                    @if($item->status == 1)
                        <b style="color:green">Đã hoàn thành</b>
                    @elseif($item->status == -1)
                        <b style="color:orange">Chưa duyệt</b>
                    @else
                        <b style="color:red">Chưa hoàn thành</b>
                    @endif
                    </td>
                </tr>
            @endforeach
            </table>
            <center>{{$order->links()}}</center>
            @else
            <div class="desc">
                <center>Bạn chưa có đơn hàng nào!</center>
            </div>
            @endif
        </div>
    </div>
@endsection