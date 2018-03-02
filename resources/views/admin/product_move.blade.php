@extends('admin.master', ['title' => 'Di chuyển sản phẩm'])
@section('content')
<div class="container">
    <div class="row">
        <h1 class="title"><span>
            Di chuyển sản phẩm</span></h1>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="form-group">
                <form method="post" class="form">
                    {{csrf_field()}}
                    <label for="">Di chuyển <b>{{count($product_id)}}</b> sản phẩm tới: </label>
                    <select name="catId">
                            @foreach (App\Category::all() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                    </select>
                    <button class="btn-green">Lưu lại</button>
                </form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection