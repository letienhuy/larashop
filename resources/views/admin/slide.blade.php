@extends('admin.master', ['title' => 'Quản lí slide'])
@section('content')
    <div class="container">
    <h1 class="title">
    <span>QUẢN LÍ slide</span>
    </h1>
        <div class="row desc">
            @if(count($slide) != 0)
            <table class="table table-striped">
            <tr>
                <th class="hidden-xs">ID</th>
                <th>URL ảnh</th>
                <th>Action</th>
            </tr>
            @foreach($slide as $s)
                <tr>
                    <td class="hidden-xs">{{$s->id}}</td>
                    <td style="word-break: break-all">{{$s->url}}</td>
                    <td>
                        <a href="{{route('admin.slide', ['action' => 'new', 'id' => $s->id])}}"><button class="btn-green left">Sửa</button></a>
                        <button class="btn-red left" onclick="removeSlide({{$s->id}})">Xoá</button>
                    </td>
                </tr>
            @endforeach
            </table>
            <center>{{$slide->links()}}</center>
            @else
            <div class="desc">
                <center>Chưa có slide ảnh nào!</center>
            </div>
            @endif
            <div class="left"><a href="{{route('admin.slide', ['action' => 'new'])}}"><button class="btn-green">Thêm mới</button></a></div>
        </div>
    </div>
@endsection