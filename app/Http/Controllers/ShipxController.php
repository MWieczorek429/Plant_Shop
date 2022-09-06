<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Admin;
use Session;
class ShipxController extends Controller
{
    public function login(Request $request)
    {

        $login = Admin::where('login', $request->login)->first();
        $password = $request->password;

        if(($login != null) && $password == Admin::where('id',$login->id)->value('password'))
        {
            Session::push('isAdmin', $login->id);
            return redirect()->route('shipx.home');
        }

        return back()->with(['message' => 'Nieprawidłowy login lub hasło']);
    }

    public function logout()
    {
        Session::remove('isAdmin');

        return redirect()->route('shipx.login.view');
    }

    public function showOrders()
    {
        $orders = Order::all()->reverse();

        return view('shipx/main', compact('orders'));
    }

    public function orderDetail(Order $order){

        $customer = json_decode($order->customer);
        $products = json_decode($order->detail, true);

        return view('/shipx/detail', compact('products','customer','order'));
    }

    public function changeStatus(Order $order)
    {
        $order->update([
            'shipped' => true,
        ]);

        return redirect()->back();
    }
}
