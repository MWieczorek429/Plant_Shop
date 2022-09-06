<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function showProducts(){

        $products = Product::select('*')
            ->where('stock', '>', 0)
            ->where('available', '=', 1)
            ->get();

        return view('home', compact('products'));
    }

    public function productDetail(Product $product)
    {

        if($product->available){

            return view('detail', compact('product'));
        }

        return abort(404);
    }
}
