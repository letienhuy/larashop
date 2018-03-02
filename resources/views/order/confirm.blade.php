<div class="dialog">
<div class="dialog-head">
Thông báo
<span class="closex">&times;</span>
</div>
<div class="dialog-body">
<center>
Đặt hàng thành công. Chúng tôi đã ghi nhận đơn hàng của bạn, mã đơn hàng <b>{{$order->order_code}}</b>. Bạn có thể kiểm tra 
tình trạng đơn hàng tại <a href="{{route('order.tracking')}}">{{route('order.tracking')}}</a>
@if($payment->type == 2)
    <br>
    Bạn vui lòng thanh toán đối với hình thức thanh toán online để đơn hàng được duyệt. Xin cảm ơn!
    <div class="form">
    <a href="{{$urlPayment}}"><button class="btn-red">@lang('order.paynow')</button></a>
    </div>
@endif
</center>
</div>
</div>