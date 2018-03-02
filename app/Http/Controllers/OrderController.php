<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Cart;
use App\Address;
use App\Order;
use App\OrderDetail;
use App\Payment;
class OrderController extends Controller
{
    //
    public function checkout(Request $request){
        if(!session()->has('cart') || count(session('cart')->items) == 0)
            return redirect('cart');
        if(\Auth::check())
            $address = \Auth::user()->address;
        return view('order.checkout', ['cart' => Cart::get(), 'address' => $address ?? null]);
    }
    public function confirm(Request $request){
        $merchantId = 11358;
        $apiUser = '5f5575e83ca44bef949b760ba6a6864b';
        $apiPass = '74fdf17792244540918609b78a9097c6';
        $urlPayment = "https://vippay.vn/atm-checkout.html";
        $urlReturn = url('order/done');
        if(isset($request->addressId) && \Auth::check()){
            if($request->paymentType == 2){
                $request->validate([
                    'addressId' => 'required',
                    'paymentType' => 'required',
                    'bank' => 'required'
                ]);
            }else{
                $request->validate([
                    'addressId' => 'required',
                    'paymentType' => 'required'
                ]);
            }
            $addr = Address::find($request->addressId);
            $pay = new Payment;
            $pay->type = $request->paymentType;
            $order = new Order;
            $order->user_id = \Auth::id();
            $order->address_id = $addr->id;
            $order->note = $request->note;
            $order->status = -1; //-1 chua duyet|0 chua hoan thanh|1 da hoan thanh
            $order->total = session('cart')->total;
            $order->order_code = time();
            $order->save();
            foreach(session('cart')->items as $item){
                $order_detail = new OrderDetail;
                $order_detail->product_id = $item->product->id;
                $order_detail->order_id = $order->id;
                $order_detail->price = $item->product->new_price;
                $order_detail->quantity = $item->quantity;
                $order_detail->save();
            }
            $pay->order_id = $order->id;
            $pay->save();
            $sign = hash('sha256',$merchantId.'-'.$order->order_code.'-'.$order->total.'-'.$request->bank.'-'.$apiUser.'-'.$apiPass.'-'.$urlReturn);
            $urlPayment .= "?merchant_id=$merchantId&payment_type=0&amount=$order->total&order_code=$order->order_code&bank=$request->bank&urlreturn=$urlReturn&sign=$sign";
            session()->forget('cart');
            return view('order.confirm', ['address' => $addr, 'payment' => $pay, 'order' => $order, 'urlPayment' => $urlPayment]);
        }else{
            if($request->paymentType == 2){
                $request->validate([
                    'city' => 'required',
                    'district' => 'required',
                    'commune' => 'required',
                    'fullname' => 'required',
                    'phone' => 'required',
                    'street' => 'required',
                    'paymentType' => 'required',
                    'bank' => 'required'
                ]);
            }else{
                $request->validate([
                    'city' => 'required',
                    'district' => 'required',
                    'commune' => 'required',
                    'fullname' => 'required',
                    'phone' => 'required',
                    'street' => 'required',
                    'paymentType' => 'required'
                    ]);
            }
            $addr = new Address;
            $addr->city = \App\City::find($request->city)->name;
            $addr->district = \App\District::find($request->district)->name;
            $addr->commune = \App\Commune::find($request->commune)->name;
            $addr->fullname = $request->fullname;
            $addr->phone = $request->phone;
            $addr->street = $request->street;
            $addr->user_id = 0;
            $addr->save();
            $pay = new Payment;
            $pay->type = $request->paymentType;
            $order = new Order;
            $order->user_id = 0;
            $order->address_id = $addr->id;
            $order->total = session('cart')->total;
            $order->note = $request->note;
            $order->order_code = time();
            $order->status = -1; //-1 chua duyet|0 chua hoan thanh|1 da hoan thanh
            $order->save();
            foreach(session('cart')->items as $item){
                $order_detail = new OrderDetail;
                $order_detail->product_id = $item->product->id;
                $order_detail->order_id = $order->id;
                $order_detail->price = $item->product->new_price;
                $order_detail->quantity = $item->quantity;
                $order_detail->save();
            }
            $pay->order_id = $order->id;
            $pay->save();
            $sign = hash('sha256',$merchantId.'-'.$order->order_code.'-'.$order->total.'-'.$request->bank.'-'.$apiUser.'-'.$apiPass.'-'.$urlReturn);
            $urlPayment .= "?merchant_id=$merchantId&payment_type=0&amount=$order->total&order_code=$order->order_code&bank=$request->bank&urlreturn=$urlReturn&sign=$sign";
            session()->forget('cart');
            return view('order.confirm', ['address' => $addr, 'payment' => $pay, 'order' => $order, 'urlPayment' => $urlPayment]);
        }
        abort();
    }
    public function order_tracking(Request $request, $orderId){
        $order = Order::where('order_code', $orderId)->get()->first();
        if(!$order)
            return view('order.tracking');
        return view('order.order_tracking', ['req' => $request,'order' => $order]);
    }
    public function tracking(Request $request){
        if($request->method() == "POST"){
            $order = Order::where('order_code', $request->orderId)->get()->first();
            if(!$order)
                return redirect()->back()->withErrors(['error' => 'Không tìm thấy đơn hàng nào!']);
            return redirect()->route('order.order_tracking', ['orderId' => $order->order_code]);
            
        }
        return view('order.tracking');
    }
}
