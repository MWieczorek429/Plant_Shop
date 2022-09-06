@extends('layouts/shop')
@section('title')
    Koszyk
@endsection
@section('content')
@if(Session::has('cart'))
    <section class="flex flex-col mx-6 lg:justify-between lg:flex-row lg:max-w-desktop lg:mx-auto lg:px-12">
    <div class="md:w-96 md:mx-auto lg:mx-0">
    @foreach ($products as $product)
        <div class="flex mt-6 max-w-64">
            <img width="94px" height="94px" class="shadow-md" src="{{ asset('images/'.$product['product']['image']) }}">
            <div class="flex flex-col ml-6 grow">
               <div>{{ $product['product']['name'] }}</div> 
               <div class="text-slate-500">Ilość: {{ $product['quantity'] }}</div>
               <div class="grow pt-8">{{ number_format($product['price'], 2) }} zł</div>
            </div>

            <form method="POST" action="{{ route('cart.remove', $product) }}">
                @csrf
                <button class="block w-16 h-full focus:ring-2 focus:ring-gray-700 bg-slate-800 hover:bg-slate-900 justify-around text-white items-centerl rounded-sm"><i class="fa-solid fa-trash"></i></button>
            </form>

        </div>
    @endforeach
    @if(Session::has('message'))
    <div class="block bg-red-600 text-white text-center mt-4 p-3 rounded-sm">
        {{ Session::get('message') }}
    </div>
    @endif
        <hr class="mt-6">
        <div class="flex justify-between px-3 mt-1">
            <span>Suma:</span>
            <span>{{ number_format($cart->totalPrice, 2) }} zł</span>
        </div>
    </div>

        <div class="block mt-8 md:w-96 md:mx-auto lg:ml-6 lg:mr-0">
            <form method="POST" action="{{ route('payment.create') }}">
                @csrf
                <div>
                    <label class="block">Imię</label>
                    <input name="firstname" value="{{ old('firstname') }}" placeholder="Imię" type="text" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-green-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    @error('firstname')
                        <div class="text-red-500 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="block">Nazwisko</label>
                    <input name="lastname" value="{{ old('lastname') }}" placeholder="Nazwisko" type="text" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-green-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    @error('lastname')
                        <div class="text-red-500 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="block">Email</label>
                    <input name="email" value="{{ old('email') }}" type="email" placeholder="Email" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-green-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    @error('email')
                        <div class="text-red-500 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="block">Miejscowość</label>
                    <input name="city" value="{{ old('city') }}" placeholder="Miejscowość" type="text" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-green-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    @error('city')
                        <div class="text-red-500 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="block">Kod pocztowy</label>
                    <input name="zip" value="{{ old('zip') }}" placeholder="Kod pocztowy" type="text" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-green-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    @error('zip')
                        <div class="text-red-500 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="block">Ulica i numer</label>
                    <input name="street" value="{{ old('street') }}" placeholder="Ulica i numer" type="text" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-green-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    @error('street')
                        <div class="text-red-500 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <label class="block">Telefon</label>
                    <input name="phone" value="{{ old('phone') }}" placeholder="+48 |" type="text" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-green-500 block w-full rounded-md sm:text-sm focus:ring-1">
                    @error('phone')
                        <div class="text-red-500 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="block mt-8">
                    <input type="submit" value="Podsumowanie" class="bg-green w-full py-2 text-center text-white border-green-light cursor-pointer rounded-sm shadow-sm focus:ring-2 focus:ring-green-700">
                </div>
            </form>
        </div>
    </section>
@else 
<section>
    <div class="block m-6 lg:max-w-desktop lg:mx-auto md:pl-12">
        <h1 class="font-normal text-lg md:text-xl">Koszyk jest pusty.</h1>
    </div>
</section>
@endif
@endsection