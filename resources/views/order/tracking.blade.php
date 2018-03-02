@extends('master', ['title' => 'Kiểm tra đơn hàng'])
@section('content')
<div class="container">
    <div class="row">
    <h1 class="title"><span>
    Kiểm tra đơn hàng
    </span></h1>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form action="{{route('order.tracking')}}" class="form" method="post">
                    @if($errors->has('error'))
                        <div class="alert alert-danger">{{$errors->first('error')}}</div>
                    @endif
                    {{ csrf_field() }}
                    <label for="orderId">Mã đơn hàng:</label>
                    <input type="text" name="orderId" id="">
                    <button class="btn-red">Kiểm tra</button>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection