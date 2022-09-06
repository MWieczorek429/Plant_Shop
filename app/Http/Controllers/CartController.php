<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart\Cart;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use Session;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function showCart(){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $products = $cart->products;
        if(Session::has('cart')){
            foreach($products as $product){
                $item = Product::select('available')->where('id','=',$product['id'])->first();
                if(!$item['available']){
                    $cart->remove($product['id']);
                    $cart->totalQuantity < 1 ? Session::remove('cart') : Session::put('cart', $cart);

                    return redirect()->refresh()->with(['message' => 'Jeden z porduktów nie jest już dostępny.']);
                }
            }
        }
        return view('cart', compact('products', 'cart'));
    }

    public function addProduct(Request $request, Product $product){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $request->get('quantity'));
        Session::put('cart', $cart);

       return redirect()->back();
    }

    public function removeProduct(Request $request, Product $product){

        $cart = new Cart(Session::get('cart'));
        $cart->remove($product->id);
        $cart->totalQuantity < 1 ? Session::remove('cart') : Session::put('cart', $cart);

        return redirect()->back();

    }
}
