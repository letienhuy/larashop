@extends('admin.master') @section('content')
<div class="container">
	<div class="col-md-4">
		<ul class="list-group">
			<li class="list-group-item">
				<a href="{{route('admin.user')}}">Quản lí người dùng</a>
				<span class="badge badge-primary badge-pill">{{count(App\User::all())}}</span>
			</li>
			<li class="list-group-item">
				<a href="{{route('admin.product')}}">Quản lí sản phẩm</a>
				<span class="badge badge-primary badge-pill">{{count(App\Product::all())}}</span>
			</li>
			<li class="list-group-item">
				<a href="{{route('admin.order')}}">Quản lí đơn hàng</a>
				<span class="badge badge-primary badge-pill">{{count(App\Order::all())}}</span>
			</li>
			<li class="list-group-item">
				<a href="{{route('admin.category')}}">Quản lí danh mục</a>
				<span class="badge badge-primary badge-pill">{{count(App\Category::all())}}</span>
			</li>
			<li class="list-group-item">
				<a href="{{route('admin.slide')}}">Quản lí slide</a>
			</li>
		</ul>
	</div>
	<div class="col-md-8">
		@if (count($unApproved) > 0)
		<center>
			<div class="alert alert-info"> Có
				<b>{{count($unApproved)}}</b> đơn hàng mới chưa duyệt</div>
		</center>
		@endif
		<div class="row">
			<div class="col-md-4">
				<div class="stats-blue">
					<div class="stats">
						<div class="stats-icon">
							<i class="fa fa-user fa-2x"></i>
						</div>
						<div class="stats-body">
							<span class="stats-body__head">Người dùng</span>
							<span class="stats-body__body">{{count(App\User::all())}}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="stats-green">
					<div class="stats">
						<div class="stats-icon">
							<i class="fa fa-list fa-2x"></i>
						</div>
						<div class="stats-body">
							<span class="stats-body__head">Đơn hàng</span>
							<span class="stats-body__body">{{count(App\Order::all())}}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="stats-orange">
					<div class="stats">
						<div class="stats-icon">
							<i class="fa fa-cubes fa-2x"></i>
						</div>
						<div class="stats-body">
							<span class="stats-body__head">Sản phẩm</span>
							<span class="stats-body__body">{{count(App\Product::all())}}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row desc">
			<h1 class="title">
				<span>DANH SÁCH ĐƠN HÀNG</span>
			</h1>
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
</div>
@endsection