@extends('admin.master', ['title' => 'Quản lí đơn hàng'])
@section('content')
<div class="container">
	<div class="row desc">
		<h1 class="title">
			<span>DANH SÁCH ĐƠN HÀNG</span>
        </h1>
        <div class="desc">
            <form id="order-filter">
                Lọc: 
                <select name="filters" onchange="submitForm('order-filter')">
                    <option value="">----------</option>
                    <option value="all">Tất cả</option>
                    <option value="unapproved">Chưa duyệt</option>
                    <option value="approved">Đã duyệt</option>
                    <option value="success">Đã hoàn thành</option>
                </select>
            </form>
        </div>
		@if(count($order) != 0)
		<table class="table table-striped">
			<tr>
				<th>Mã đơn hàng</th>
				<th class="hidden-xs">Ngày tạo</th>
				<th>Số tiền</th>
				<th>Trạng thái</th>
				<th class="hidden-xs">Action
				</th>
			</tr>
			@foreach($order as $item)
			<tr>
				<td>
					<a href="{{route('order.order_tracking', ['orderId' => $item->order_code])}}">{{$item->order_code}}</a>
				</td>
				<td class="hidden-xs">{{date('d-m-Y H:m', strtotime($item->created_at))}}</td>
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
				<td class="hidden-xs">
					@if($item->status == 0)
					<div id="close-order">
						<a href="{{route('admin.order', ['action' => 'close', 'id' => $item->id])}}">
							<button class="btn-green left">Đóng đơn hàng</button>
						</a>
						<div class="tips">
							<b>Lưu ý</b>: chỉ đóng đơn hàng khi khách đã nhận được hàng!
						</div>
					</div>
					@elseif($item->status == -1)
					<a href="{{route('admin.order', ['action' => 'approve', 'id' => $item->id])}}">
						<button class="btn-blue left">Duyệt đơn</button>
					</a>
					@endif
				</td>
			</tr>
			@endforeach
		</table>
		<center>{{$order->links()}}</center>
		@else
		<div class="desc">
			<center>Chưa có đơn hàng nào!</center>
		</div>
		@endif
	</div>
</div>
@endsection