@extends('layouts/shop')
@section('title')
    Podsumowanie
@endsection
@section('content')
    <section class="flex flex-col mx-6 md:justify-between md:flex-row lg:max-w-desktop lg:mx-auto lg:px-12">
    
        
    <div class="md:w-96 lg:mr-4">

        @foreach ($products as $product)

        <div class="flex mt-6 max-w-64">
            <img width="94px" height="94px" class="shadow-md" src="{{ asset('images/'.$product['product']['image']) }}">
            <div class="flex flex-col ml-6 grow">
               <div>{{ $product['product']['name'] }}</div> 
               <div class="text-slate-500">Ilość: {{ $product['quantity'] }}</div>
               <div class="grow pt-8">{{ number_format($product['price'], 2) }} zł</div>
            </div>
        </div>  

        @endforeach

        <hr class="mt-6">
        <div class="flex justify-between px-3 mt-1">
            <span>Suma:</span>
            <span>{{ number_format($cart->totalPrice, 2) }} zł</span>
        </div>
    </div>
        <div class="block mt-8 md:w-96 md:ml-6 lg:ml-0">
            <div>
                <label class="block">Imię i naziwsko</label>
                <span class="text-sm text-slate-500">{{ $customer['firstname'] }} {{ $customer['lastname'] }}</span>
            </div>
            <div class="mt-2">
                <label class="block">Email</label>
                <span class="text-sm text-slate-500">{{ $customer['email'] }}</span>
            </div>
            <div class="mt-2">
                <label class="block">Miejscowość</label>
                <span class="text-sm text-slate-500">{{ $customer['city'] }}</span>
            </div>
            <div class="mt-2">
                <label class="block">Kod pocztowy</label>
                <span class="text-sm text-slate-500">{{ $customer['zip'] }}</span>
            </div>
            <div class="mt-2">
                <label class="block">Ulica i numer</label>
                <span class="text-sm text-slate-500">{{ $customer['street'] }}</span>
            </div>
            <div class="mt-2">
                <label class="block">Telefon</label>
                <span class="text-sm text-slate-500">+48 {{ $customer['phone'] }}</span>                
            </div>
            <div class="block mt-8">
            <form method="POST" action="{{ route('payment.process') }}">
                <input type="submit" value="Zapłać: {{ number_format(Session::get('cart')->totalPrice,2) }} zł" class="bg-green w-full py-2 text-center text-white border-green-light cursor-pointer rounded-sm shadow-sm focus:ring-2 focus:ring-green-700">
            </form>
            </div>
        </div>
    </section>
@endsection