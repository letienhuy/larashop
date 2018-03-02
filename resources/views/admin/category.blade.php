@extends('admin.master', ['title' => 'Quản lí danh mục'])
@section('content')
    <div class="container">
    <h1 class="title">
    <span>QUẢN LÍ DANH MỤC</span>
    </h1>
        <div class="row desc">
            @if ($errors->has('error'))
                <div class="alert alert-danger">{{$errors->first('error')}}</div>
            @endif
            @if(count($category) != 0)
            <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th class="hidden-xs">Mô tả</th>
                <th>Thư mục cha</th>
                <th>Action</th>
            </tr>
            @foreach($category as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td><a href="{{route('admin.product', ['action' => '','catId' => $c->id])}}">{{$c->name}} ({{count($c->product)}} SP)</a></td>
                    <td class="hidden-xs">{{$c->description}}</td>
                    <td>{{$c->parent->name ?? 'Không'}}</td>
                    <td>
                        <a href="{{route('admin.category', ['action' => 'edit', 'id' => $c->id])}}"><button class="btn-blue left">Sửa</button></a>
                        <button class="btn-red left" onclick="removeCategory({{$c->id}})">Xoá</button>
                    </td>
                </tr>
            @endforeach
            </table>
            <center>{{$category->links()}}</center>
            @else
            <div class="desc">
                <center>Chưa có danh mục!</center>
            </div>
            @endif
            <div class="left"><a href="{{route('admin.category', ['action' => 'new'])}}"><button class="btn-green">Thêm mới</button></a></div>
        </div>
    </div>
@endsection