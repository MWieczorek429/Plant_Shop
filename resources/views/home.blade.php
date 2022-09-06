@extends('layouts/shop')
@section('title')
    Strona główna
@endsection
@section('content')
    <section class="flex flex-wrap mx-6 sm:grid sm:grid-cols-2 lg:grid-cols-3 lg:max-w-desktop lg:mx-auto">

        @foreach ($products as $product)
        <div class="flex flex-col items-center max-w-product mx-auto mt-8 sm:p-4 md:p-0">
            <a href="{{ route('detail', $product->id) }}">
                <div class="text-center">
                    <img width="226px" height="226px" class="shadow-md rounded-md" src="{{ asset('images/'.$product->image) }}">
                    <div class=" font-medium mt-2">{{ $product->name }}</div>
                    <div class="text-slate-600 mb-1">{{  number_format($product->price, 2)  }} zł</div>
                </div>
            </a>
            <div class="w-9/12">
                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <input type="hidden" name="quantity" value="1"> 
                    <input type="submit" value="Dodaj do koszyka" class="bg-green w-full text-center text-sm text-white py-1 border-green-light cursor-pointer rounded-sm shadow-sm focus:ring-2 focus:ring-green-700">
                </form>
            </div>
        </div>
        @endforeach

    </section>
@endsection