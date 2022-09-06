<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart\Cart;
use Session;
use App\DotpayManager\DotpayManager;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;

class PaymentController extends Controller
{
    public function showSummary(Request $request){

        if(!Session::has('cart')){


            return redirect()->route('home');
        }

        $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required' ,'email:rfc,dns'],
            'city' => ['required'],
            'zip' => ['required'],
            'street' => ['required'],
            'phone' => ['required', 'size:9'], 
        ],

        $messages = [
            '*.required' => 'Pole jest wymagane. Uzupełnij dane',
            'email' => 'Ten email jest niepoprawny.',
            'phone.size' => 'Niepoprawny numer telefonu.',
        ]);

        $cart = new Cart(Session::get('cart'));
        $products = $cart->products;


        $customer = array(
            'firstname' => ucwords($request->get('firstname')),
            'lastname' => ucwords($request->get('lastname')),
            'email' => $request->get('email'),
            'city' => $request->get('city'),
            'zip' => $request->get('zip'),
            'street' => $request->get('street'),
            'phone' => (string)$request->get('phone'),
        );

        Session::put('customer', $customer);

        return view('payment/create', compact('cart', 'products', 'customer'));
    }

    public function paymentProcess(Request $request){

        if(!Session::has('cart')){
            return abort(404);
        }
         
        $cart = new Cart(Session::get('cart'));
        $customer = Session::get('customer');

        foreach($cart->products as $product){
            $item = Product::select('available')->where('id','=',$product['id'])->first();
            if(!$item['available']){
                $cart->remove($product['id']);
                $cart->totalQuantity < 1 ? Session::remove('cart') : Session::put('cart', $cart);

                return redirect()->route('cart')->with(['message' => 'Jeden z porduktów nie jest już dostępny.']);
            }
        }

        foreach($cart->products as $product){

            $item = Product::where('id',$product['id'])->first();
            if($item['stock'] - $product['quantity'] >= 0){

                Product::where('id',$product['id'])->
                update([
                    'stock' => $item['stock'] - $product['quantity'],
                ]);

                $item = Product::where('id',$product['id'])->first();
                if($item['stock'] <= 0){

                    Product::where('id',$product['id'])->
                    update([

                        'available' => false,
                    ]);
                }
            }
            else
            {
                return redirect()->route('cart')->with(['message' => 'Produkt "'.$item['name'].'" nie jest dostępny w podanej ilości, spróbuj ponowanie dodać go do koszyka.']);
            }
        }

        $order = Order::create([
            'customer' => json_encode($customer, JSON_UNESCAPED_UNICODE),
            'detail' => Session::get('cart')->toJson(), 
        ]);

        $orderID = $order->id;

        $url = 'https://'.env('SERVER_IP').'/GreenHouse/public/payment/done/'.$orderID;

        $dotpayManager = new DotpayManager(
            strval($cart->countTotalPrice($cart->products)),
            $customer['email'],
            $customer['firstname'],
            $customer['lastname'],
            strval($orderID),
            'Zamówienie '.$orderID,
            $url,
        );

        $dotpayManager->city = $customer['city'];
        $dotpayManager->postcode = $customer['zip'];
        $dotpayManager->street = $customer['street'];
        $dotpayManager->phone = '+48 '.$customer['phone'];

        $parametersList = $dotpayManager->createParamtersArray();

        Session::remove('cart');
        Session::remove('customer');

        return view('payment/process', compact('parametersList'));
    }

    public function urlcReceiver(Request $request)
    {
        if($request->get('operation_status') == 'completed'){

            $amount = Order::where('id', $request->get('control'))->first();
            $amount = $amount->customer;
            $amount = json_decode($amount, true);
            $amount['amount'] = $request->get('operation_amount');
            Order::where('id', $request->get('control'))
                ->update([
                    'paid' => true,
                    'customer' => json_encode($amount),
                ]);

        }

        return new Response('OK');
    }

    public function paymentSuccess(Request $request, Order $order){

        if($request->get('status') == 'OK'){

            $orderID = $order->id;

            return view('payment/done', compact('orderID'));
        }
        
        return redirect()->route('payment.canceled');
    }
}
