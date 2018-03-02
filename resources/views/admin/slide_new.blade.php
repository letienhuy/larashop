@extends('admin.master', ['title' => 'Thêm mới silde'])
@section('content')
<div class="container">
    <div class="row">
        <h1 class="title"><span>Thêm slide</span></h1>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                <form method="post" action="{{route('admin.slide', ['action'=>'new'])}}" enctype="multipart/form-data" class="form">
                    {{csrf_field()}}
                    <label for="">Link ảnh:</label>
                    <input type="text" name="url" id="">
                    <label for="">hoặc tập tin (có thể chọn nhiều):</label>
                    <input type="file" multiple name="image[]" id="">
                    <button class="btn-green">Lưu ảnh</button>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection