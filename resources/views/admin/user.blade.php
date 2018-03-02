@extends('admin.master', ['title' => 'Quản lí người dùng'])
@section('content')
    <div class="container">
    <h1 class="title">
    <span>QUẢN LÍ NGƯỜI DÙNG</span>
    </h1>
        <div class="row desc">
            @if(count($user) != 0)
            <table class="table table-striped">
            <tr>
                <th class="hidden-xs">ID</th>
                <th>Email</th>
                <th class="hidden-xs">Họ tên</th>
                <th class="hidden-xs">Số Điện Thoại</th>
                <th class="hidden-xs">Giới tính</th>
                <th>Quản trị viên</th>
                <th>Action</th>
            </tr>
            @foreach($user as $u)
                <tr>
                    <td class="hidden-xs">{{$u->id}}</td>
                    <td>{{$u->email}}</td>
                    <td class="hidden-xs">{{$u->fullname}}</td>
                    <td class="hidden-xs">0{{$u->phone}}</td>
                    <td class="hidden-xs">{{$u->gender ? 'Nữ' : 'Nam'}}</td>
                    <td>
                        <input type="checkbox" {{$u->right ? 'checked':''}} disabled>
                    </td>
                    <td>
                        @if($u->right)
                        <a href="{{route('admin.user', ['action' => 'right', 'id' => $u->id, 'type' => 'down'])}}"><button class="btn-blue left">Hạ quyền</button></a>
                        @else
                        <a href="{{route('admin.user', ['action' => 'right', 'id' => $u->id, 'type' => 'up'])}}"><button class="btn-blue left">Nâng quyền</button></a>
                        @endif
                        <button class="btn-red left" onclick="removeUser({{$u->id}})">Xoá</button>
                    </td>
                </tr>
            @endforeach
            </table>
            <center>{{$user->links()}}</center>
            @else
            <div class="desc">
                <center>Chưa có người dùng nào!</center>
            </div>
            @endif
        </div>
    </div>
@endsection