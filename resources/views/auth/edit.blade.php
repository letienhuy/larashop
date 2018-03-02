@extends('master', ['title' => 'Sửa thông tin cá nhân'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('auth.side')
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <form action="{{route('auth.edit.info')}}" id="edit-info" method="post" class="form">
                    <div id="result"></div>
                    {{csrf_field()}}
                    <label for="avatar">Avatar (Để trống nếu không thay đổi):</label>
                    <input type="file" name="avatar" id="avatar">
                    <label for="fullname">@lang('auth.fullname')</label>
                    <input type="text" name="fullname" id="fullname" value="{{Auth::user()->fullname}}">
                    <label for="phone">@lang('auth.phone')</label>
                    <input type="text" name="phone" id="phone" value="{{Auth::user()->phone}}">
                    <label for="gender">@lang('auth.gender')</label>
                    <select name="gender" id="gender">
                        <option {{Auth::user()->gender ?: 'selected'}} value="0">@lang('auth.male')</option>
                        <option {{Auth::user()->gender ? 'selected' : ''}} value="1">@lang('auth.female')</option>
                    </select>
                    <label for="birthday">@lang('auth.birthday')</label>
                    <div class="input-group">
                        <select name="day" id="day">
                        @for($i = 1; $i <= 31; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                        <select name="month" id="month">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                        <select name="year" id="year">
                            @for($i = date('Y'); $i >= 1970; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                    </div>
                    <button class="btn-blue">LƯU THÔNG TIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection