@extends('master', ['title' => 'Chi tiết đơn hàng - '.$order->order_code])
@section('content')
<div class="container">
<div class="row">
<div class="col-md-4">
	<h1 class="title">
		<span>Địa chỉ nhận hàng</span>
	</h1>
	<div class="desc">
		<b>{{$order->address->fullname}}
			<br>0{{$order->address->phone}}</b>
		<br>{{$order->address->city}}
		<br>{{$order->address->district}}
		<br>{{$order->address->commune}}
		<br>{{$order->address->street}}
	</div>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
	<h1 class="title">
		<span>Thông tin đơn hàng</span>
	</h1>
	<div class="desc">
		Tình trạng đơn hàng:
		@if($order->status == 1)
			<b style="color:green">Đã hoàn thành</b>
		@elseif($order->status == -1)
			<b style="color:orange">Chưa duyệt</b>
		@else
			<b style="color:red">Chưa hoàn thành</b>
		@endif
		<br>
		Giá trị đơn hàng:
		<b style="color:red">{{$order->total}}đ</b><br>
		Hình thức thanh toán:
		<b>{{$order->payment->type ? 'Thanh toán khi nhận hàng' : 'Thanh toán online'}}</b>
		<br> Trạng thái:
		<b>{!!$order->payment->status ? '<b style="color:green">Đã thanh toán</b>' : '<b style="color:red">Chưa thanh toán</b>'!!}</b>
	</div>
</div>
</div>
<div class="row desc">
	<table class="table table-striped">
		<tr>
			<th>Sản phẩm</th>
			<th>Số lượng</th>
			<th>Đơn giá</th>
			<th>Thành tiền</th>
		</tr>
		@foreach($order->orderDetail as $item)
		<tr>
			<td>
				@if(Empty($item->product))
					Sản phẩm này đã bị xoá
				@else
				<a href="{{route('product.detail', ['uri' => Helper::seo($item->product->name) , 'id' => $item->product->id])}}">{{$item->product->name}}</a>
				@endif
			</td>
			<td>{{$item->quantity}}</td>
			<td>{{$item->price}}đ</td>
			<td>{{$item->quantity*$item->price}}đ</td>
		</tr>
		@endforeach
	</table>
	<center>
			@if($order->status == 0)
			<div id="close-order">
				<a href="{{route('admin.order', ['action' => 'close', 'id' => $order->id])}}">
					<button class="btn-green">Đóng đơn hàng</button>
				</a>
				<div class="tips">
					<b>Lưu ý</b>: chỉ đóng đơn hàng khi khách đã nhận được hàng!
				</div>
			</div>
			@elseif($order->status == -1)
			<a href="{{route('admin.order', ['action' => 'approve', 'id' => $order->id])}}">
				<button class="btn-blue">Duyệt đơn</button>
			</a>
			@endif
	</center>
</div>
</div>
@endsection