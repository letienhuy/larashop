<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{asset('assets/styles/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('assets/styles/font-awesome.css')}}">
	<link rel="stylesheet" href="{{asset('assets/styles/admin.css')}}">
	<link rel="stylesheet" href="{{asset('assets/styles/style.css')}}">
	<title>{{$title ?? 'Admin Cpanel'}}</title>
</head>
<body>
	<header>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9"
				 aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{{route('admin')}}" class="navbar-brand active">Admin Cpanel</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
				<ul class="nav navbar-nav">
					<li>
						<a href="{{route('admin.user')}}">Quản lí người dùng</a>
					</li>
					<li>
						<a href="{{route('admin.product')}}">Quản lí sản phẩm</a>
					</li>
					<li>
						<a href="{{route('admin.category')}}">Quản lí danh mục</a>
					</li>
					<li>
						<a href="{{route('admin.order')}}">Quản lí đơn hàng</a>
					</li>
					<li>
						<a href="{{route('logout')}}">Đăng xuất</a>
					</li>
				</ul>
			</div>
		</div>
	</nav></header>
	@yield('content')
	<footer>
	<center>&#169; Copyright 2017</center>
	</footer>
	<script src="{{asset('assets/js/jquery-3.2.1.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.js')}}"></script>
	<script src="{{asset('assets/js/admin.js')}}"></script>
</body>

</html>