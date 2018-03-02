<div class="auth-side">
    <div class="side-title">
        THÔNG TIN TÀI KHOẢN
    </div>
    <ul>
        @if(Auth::user()->right === 1)
            <li><a href="{{route('admin')}}" style="font-weight: bold; color: #f00 !important;">Admin Cpanel</a></li>
        @endif
        <li>
            <a href="{{route('auth.edit.info')}}">Sửa thông tin tài khoản</a>
        </li>
        <li>
            <a href="{{route('auth.my.order')}}">Đơn hàng của tôi</a>
        </li>
        <li>
            <a href="{{route('auth.my.rate')}}">Đánh giá của tôi</a>
        </li>
        <li>
            <a href="{{route('auth.link.social')}}">Liên kết mạng xã hội</a>
        </li>
        <li>
            <a href="{{route('auth.edit.password')}}">Đổi mật khẩu</a>
        </li>
        <li>
            <a href="{{route('auth.address.list')}}">Sổ địa chỉ</a>
        </li>
    </ul>
</div>