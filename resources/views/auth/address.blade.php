@extends('master', ['title' => 'Sổ địa chỉ'])
@section('content')
    <div class="container">
    <h1 class="title">
    <span>Sổ địa chỉ</span>
    </h1>
        <div class="row desc">
            @if(count($address) != 0)
            <table class="table table-striped">
            <tr>
                <th>Họ tên</th>
                <th>SĐT</th>
                <th>Tỉnh/Thành Phố</th>
                <th>Quận/Huyện</th>
                <th>Xã/Phường</th>
                <th>Số nhà, đường phố</th>
                <th>Action</th>
            </tr>
            @foreach($address as $addr)
                <tr>
                    <td>{{$addr->fullname}}</td>
                    <td>{{$addr->phone}}</td>
                    <td>{{$addr->city}}</td>
                    <td>{{$addr->district}}</td>
                    <td>{{$addr->commune}}</td>
                    <td>{{$addr->street}}</td>
                    <td>
                    @if($addr->default)
                        <b>Mặc định</b>
                    @else
                        <a href="{{route('auth.address.list', ['action' => 'default', 'id' => $addr->id])}}"><button class="btn-blue">Mặc định</button></a>
                        <button class="btn-red" onclick="removeAddress({{$addr->id}})">Xoá</button>
                    @endif
                    </td>
                </tr>
            @endforeach
            </table>
            @else
            <div class="desc">
                <center>Chưa có địa chỉ nào!</center>
            </div>
            @endif
            <div class="left"><a href="{{route('auth.address.list', ['action' => 'new'])}}"><button class="btn-green">Thêm mới</button></a></div>
        </div>
    </div>
@endsection