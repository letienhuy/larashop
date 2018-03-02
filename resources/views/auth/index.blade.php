@extends('master', ['title' => 'Thông tin tài khoản'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('auth.side')
            </div>
            <div class="col-md-9">
            <div class="auth-info">
                <h4>THÔNG TIN TÀI KHOẢN</h4>
                <div class="auth-item">
                    <div class="avatar">
                    <img src="{{Auth::user()->avatar ?? Auth::user()->defaultAvatar()}}" alt="Avatar">
                    </div>
                    <h2 class="name">{{Auth::user()->fullname}}</h2>
                </div>
                <div class="auth-item">
                    @lang('auth.email'): <b>{{Auth::user()->email}}</b>
                </div>
                <div class="auth-item">
                    @lang('auth.phone'): <b>0{{Auth::user()->phone}}</b>                    
                </div>
                <div class="auth-item">
                    @lang('auth.gender'): <b>{{Auth::user()->gender ? __('auth.female') : __('auth.male')}}</b>
                </div>
                <div class="auth-item">
                    @lang('auth.birthday'): <b>{{Auth::user()->birthday ?? __('auth.null')}}</b>
                </div>
                <div class="auth-item">
                    Tài khoản facebook: <b>{{Auth::user()->facebook ?? 'Chưa kết nối'}}</b>
                </div>
                <div class="auth-item">
                   Tài khoản google : <b>{{Auth::user()->google ?? 'Chưa kết nối'}}</b>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection