@extends('master', ['title' => __('auth.register')])
@section('content')
<div class="container">
    <div class="row">
        <h1 class="title"><span>
        @lang('auth.register')
        </span></h1>
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div class="form-group">
            <form method="post" id="register" class="form">
                <div id="result"></div>
                {{ csrf_field() }}
                <label for="fullname">{{__('auth.fullname')}}</label>
                <input type="text" name="fullname" id="fullname">
                <label for="email">{{__('auth.email')}}</label>
                <input type="text" name="email" id="email">
                <label for="password">@lang('auth.password')</label>
                <input type="password" name="password" id="password">
                <label for="phone">{{__('auth.phone')}}</label>
                <input type="tel" name="phone" id="phone">
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
                <input type="text" name="street" id="street">
                <button class="btn-green">{{__('auth.register')}}</button>
            </form>
        </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection
