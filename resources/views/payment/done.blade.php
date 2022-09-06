@extends('layouts/shop')
@section('title')
    Zamówienie nr {{ $orderID }}
@endsection
@section('content')
<section>
    <div class="block m-6 lg:max-w-desktop lg:mx-auto md:pl-12">
        <h1 class="font-medium text-lg md:text-xl">Płatność zakończyła się sukcesem.</h1>
        <div>Nr zamówienia: <span class="text-slate-600">{{ $orderID }}</span></div>
    </div>
</section>
@endsection