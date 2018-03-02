<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\Rate;
use App\Address;
class AuthController extends Controller
{
    public function index(){
        return view('auth.index');
    }

    public function edit(Request $req){
        $path = "";
        if($req->method() == "POST"){
            $req->validate([
                'fullname' => 'required|string|max:255',
                'phone' => 'required|between:10,11',
                'avatar' => 'image|max:1024'
            ]);
            $time = mktime(0,0,0, $req->month, $req->day, $req->year);
            if(date('m', $time) != $req->month){
                return response()->json(['errors' => ['birthday' => \Lang::get('messages.error.day')]], 422);
            }
            if($req->hasFile('avatar')){
                $fileExtension = $req->avatar->getClientOriginalExtension();
                $fileName = md5(time()).'.'.$fileExtension;
                $path = $req->avatar->move('upload/avatar/'.\Auth::id(), $fileName);
            }
            $user = \Auth::user();
            $user->fullname = $req->fullname;
            $user->phone = $req->phone;
            $user->gender = $req->gender;
            $user->birthday = date('Y-m-d', $time);
            $user->avatar = url($path);
            $user->save();
        }
        return view('auth.edit');
    }
    public function myOrder(Request $request){
        $order = Order::where('user_id', \Auth::id())->paginate(10);
        return view('auth.myorder', ['req' => $request,'order' => $order]);
    }
    public function addressList(Request $request, $action = null){
        switch($action){
            case 'new':
                if($request->method() == "POST"){
                    $request->validate([
                    'fullname' => 'required|string|max:255',
                    'phone' => 'required|between:10,11',
                    'city' => 'required',
                    'district' => 'required',
                    'commune' => 'required',
                    'street' => 'required',
                ]);
                    $addr = new Address;
                    $addr->fullname = $request->fullname;
                    $addr->phone = $request->phone;
                    $addr->city = \App\City::find($request->city)->name;
                    $addr->district = \App\District::find($request->district)->name;
                    $addr->commune = \App\Commune::find($request->commune)->name;
                    $addr->street = $request->street;
                    $addr->user_id = \Auth::id();
                    $addr->save();
                    return redirect()->route('auth.address.list');
                }else
                    return view('auth.address_new');
            break;
            case 'default':
                Address::where('user_id', \Auth::id())->update(['default' => 0]);
                $addr = Address::find($request->id);
                $addr->default = 1;
                $addr->save();
                return redirect()->route('auth.address.list');
            break;
            case 'delete':
                $addr = Address::find($request->id);
                if(!$addr->default)
                    $addr->delete();
                return redirect()->route('auth.address.list');
            break;
            default:
                $addr = \Auth::user()->address;
                return view('auth.address', ['address' => $addr]);
            break;
        }
    }
    public function myRate(){
        $rate = Rate::where('user_id', \Auth::id())->paginate(10);
        return view('auth.myrate', ['rate' => $rate]);
    }
    public function edit_password(Request $request){
        if($request->method() == "POST"){
            $request->validate([
                'oldPass' => 'required',
                'newPass' => 'required|min:6|confirmed',
            ]);
            if(!\Hash::check($request->oldPass, \Auth::user()->password)){
                return redirect()-> back()->withErrors(['oldPass' => 'Mật khẩu cũ không chính xác!']);
            }
            \Auth::user()->password = bcrypt($request->newPass);
            \Auth::user()->save();
            return redirect()->route('auth');
        }
        return view('auth.edit_password');
    }
}
