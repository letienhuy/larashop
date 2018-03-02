@extends('master', ['title' => 'Thêm địa chỉ'])
@section('content')
<div class="container">
    <div class="row">
        <h1 class="title"><span>
        Thêm địa chỉ mới
        </span></h1>
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="form-group">
            <form method="post" class="form">
            @if($errors->any())
                <div class="alert alert-danger">{{$errors->all()[0]}}</div>
            @endif
                {{ csrf_field() }}
                <label for="fullname">{{__('auth.fullname')}}</label>
                <input type="text" name="fullname" id="fullname" value="{{old('fullname')}}">
                <label for="phone">{{__('auth.phone')}}</label>
                <input type="tel" name="phone" id="phone" value="{{old('phone')}}">
                <label for="city">{{__('auth.city')}}</label>
                <select name="city" id="city">
                </select>
                <label for="district">{{__('auth.district')}}</label>
                <select name="district" id="district">
                </select>
                <label for="commune">{{__('auth.commune')}}</label>
                <select name="commune" id="commune">
                </select>
                <label for="street">{{__('auth.street')}}</label>
                <input type="text" name="street" id="street" value="{{old('street')}}">
                <button class="btn-green">Thêm mới</button>
            </form>
        </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection
