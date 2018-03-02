@extends('admin.master', ['title' => 'Thêm danh mục mới'])
@section('content')
<div class="container">
    <div class="row">
        <h1 class="title"><span>Thêm danh mục</span></h1>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                @if ($errors->any())
                    <div class="alert alert-danger">{{$errors->all()[0]}}</div>
                @endif
                <form method="post" action="{{route('admin.category', ['action'=>'new'])}}" enctype="multipart/form-data" class="form">
                    {{csrf_field()}}
                    <label for="">Tên danh mục</label>
                    <input type="text" name="name" id="" value="{{old('name')}}">
                    <label for="">Mô tả:</label>
                    <textarea name="desc" id="">{{old('desc')}}</textarea>
                    <label for="">Thuộc danh mục</label>
                    <select name="catId" id="">
                        <option value="0">Danh mục cha</option>
                        @foreach (App\Category::where('parent_id', 0)->get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn-green">Thêm mới</button>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection