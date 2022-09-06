@extends('layouts/shipx')
@section('title')
    Strona główna
@endsection
@section('content')
    <section class="flex lg:max-w-desktop lg:mx-auto">
        <div class="flex mt-12 ml-5 lg:ml-24 flex-col">
            <h1 class="text-2xl font-medium text-sky-800 pb-4">Zamówienie #{{ $order->id }}</h1>
            <ul>
                <li>Imię naziwsko: <span class="text-gray-500">{{ $customer->firstname }} {{ $customer->lastname }}</span></li>
                <li>Email: <span class="text-gray-500">{{ $customer->email }} </span></li>
                <li>Miasto: <span class="text-gray-500">{{ $customer->city }}</span></li>
                <li>Kod pocztowy: <span class="text-gray-500">{{ $customer->zip }}</span></li>
                <li>Ulica i numer: <span class="text-gray-500">{{ $customer->street }}</span></li>
                <li>Numer tel: <span class="text-gray-500">+48 {{ $customer->phone }}</span></li>
                <li>Wartość: <span class="text-gray-500">@if(isset($customer->amount)) {{ $customer->amount }} zł@else Nieopłacone @endif</span></li>
            </ul>
            <ul class="mt-5">
                @foreach ($products as $name => $quantity)
                <li>Produkt:<span class="text-gray-500"> {{ $name }}</span></li>
                <li class="mb-2">Ilość:<span class="text-gray-500"> {{ $quantity }}</span>
                @endforeach
            </ul>
            @if(!$order->shipped && isset($customer->amount))
            <div class="mt-5">
                <form method="POST" action="{{ route('shipx.update', $order) }}">
                    @csrf
                    <p>* Poniższy przycisk zmienia status na "WYSŁANE".</p>
                    <input type="submit" value="Wysłane" class="bg-sky-600 text-white p-2 rounded-md w-36 mt-3 cursor-pointer hover:bg-sky-800">
                </form>
            </div>
            @elseif(!isset($customer->amount)) 
            <div class="text-red-600">To zamówienia nie zostało jeszcze opłacone.</div>
            @else
            <div class="text-green-600">To zamówienie zostało już wysałne.</div>
            @endif
        </div>
    </section>
@endsection