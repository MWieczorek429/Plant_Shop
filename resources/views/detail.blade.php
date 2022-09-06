@extends('layouts/shop')
@section('title')
    {{ $product->name }}
@endsection
@section('content')
<section class="lg:max-w-desktop lg:mx-auto">
    <div class="lg:flex">
        <div class="mt-12 mb-4 mx-5 lg:w-5/12 lg:mr-0">
            <img class="max-w-64 max-h-64 mx-auto shadow-md rounded-md lg:max-w-80 lg:max-h-80 lg:mr-12" src="{{ asset('images/'.$product->image) }}">
        </div>
        <div class="text-center lg:text-left lg:block lg:w-3/6 lg:mt-12">
            <div class="font-medium mt-2 lg:text-2xl">{{ $product->name }}</div>
            <div class="text-slate-600 mb-1 mt-1"><span class="text-slate-800 font-medium">Cena:</span> {{  number_format($product->price, 2)  }} zł</div>
            @if($product->stock < 10)<span class="text-red-600">Ostanie sztuki!</span>@endif
            <form method="POST" action="{{ route('cart.add', $product) }}">
                @csrf
                <select name="quantity" class="border-2 pb-2 rounded border-gray-800 focus:outline-none focus:ring-2 focus:border-white focus:ring-green-700 mr-2 lg:mt-16">
                    @for($i = 1; $i <= $product->stock && $i < 10; $i++)
                    <option>{{ $i }}</option>
                    @endfor
                </select>
                <input type="submit" value="Dodaj do koszyka" class="w-52 bg-green text-center text-sm text-white py-1 border-green-light cursor-pointer rounded-sm shadow-sm focus:ring-2 focus:ring-green-700">
            </form>
            <div class="pt-8 mx-16 text-justify lg:ml-0 mr-12">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque faucibus faucibus ipsum a finibus. Duis accumsan risus velit, in vulputate magna tempus consectetur. Proin ultricies turpis id pharetra tincidunt. In sit amet lectus rutrum, lobortis sem non, pharetra metus. Vestibulum id arcu sapien. Proin in massa tortor. In hac habitasse.
            </div>
        </div>
    </div>

</section>
@endsection