@extends('master', ['title' => 'Đăng nhập'])
@section('content')
<div class="container">
    <div class="row">
    <h1 class="title"><span>
    {{__('auth.login')}}
    </span></h1>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <form action="{{route('login')}}" class="form" method="post" id="login">
                    <div id="result"></div>
                    {{ csrf_field() }}
                    <label for="email">{{__('auth.email')}}:</label>
                    <input type="text" name="email" id="email" value="{{old('email')}}" required>
                    <label for="password">{{__('auth.password')}}</label>
                    <input type="password" name="password" id="password" required>
                    <div class="input-group">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{__('auth.remember')}}</label>                       
                    </div>
                    <button class="btn-red">{{__('auth.login')}}</button>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection
