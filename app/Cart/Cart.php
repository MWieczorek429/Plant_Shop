<?php

namespace App\Cart;

use Illuminate\Support\Facades\DB;

Class Cart
{

    public  $products = null;
    public  $totalPrice = 0;
    public  $totalQuantity = 0;


    public function __construct($oldcart)
    {
        if($oldcart){
            $this->products = $oldcart->products;
            $this->totalPrice = $oldcart->totalPrice;
            $this->totalQuantity = $oldcart->totalQuantity;
        }
    }

    public function add($product, $id, $quantity = 1)
    {
        $storedProduct = ['id' =>$product->id, 'product' => $product, 'quantity' => 0 ,'price' => $product->price];
        if($this->products)
        {
            if(array_key_exists($id, $this->products))
            {
                $storedProduct = $this->products[$id];
            }
        }
        $storedProduct['quantity'] += $quantity;
        $storedProduct['price'] = $product->price * $storedProduct['quantity'];
        $this->products[$id] = $storedProduct;
        $this->totalQuantity += $quantity;
        $this->totalPrice += $product->price * $quantity;
    }

    public function remove($id)
    {
        $product = $this->products[$id];
        $this->totalQuantity -= $product['quantity'];
        $this->totalPrice -= $product['price'];
        unset($this->products[$id]);
    }

    public function toJson()
    {
        $productsList = [];

        foreach($this->products as $product)
        {
            $productsList[$product['product']['name']] = $product['quantity'];
        }
        
        return json_encode($productsList, JSON_UNESCAPED_UNICODE);
    }

    public function countTotalPrice($products)
    {
        $totalPrice = 0;
        foreach($products as $product)
        {
            $totalPrice += ((DB::table('products')
            ->select('price')
            ->where('id', $product['product']['id'])->first())
            ->price * $product['quantity']);
        }

        return $totalPrice;
    }
}