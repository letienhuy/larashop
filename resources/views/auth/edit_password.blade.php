@extends('master', ['title' => 'Đổi mật khẩu'])
@section('content')
<div class="container">
    <div class="row">
    <h1 class="title"><span>
    Đổi mật khẩu
    </span></h1>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form action="{{route('auth.edit.password')}}" class="form" method="post">
                    {{ csrf_field() }}
                    <label for="oldPass">Mật khẩu cũ:</label>
                    @if($errors->has('oldPass'))
                        <div class="alert alert-danger">{{$errors->first('oldPass')}}</div>
                    @endif
                    <input type="password" name="oldPass" id="">
                    <label for="oldPass">Mật khẩu mới:</label>
                    @if($errors->has('newPass'))
                        <div class="alert alert-danger">{{$errors->first('newPass')}}</div>
                    @endif
                    <input type="password" name="newPass" id="">
                    <label for="oldPass">Nhập lại:</label>
                    @if($errors->has('newPass_confirmation'))
                        <div class="alert alert-danger">{{$errors->first('newPass_confirmation')}}</div>
                    @endif
                    <input type="password" name="newPass_confirmation" id="">
                    <button class="btn-red">Thay đổi</button>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection