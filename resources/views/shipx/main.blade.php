@extends('layouts/shipx')
@section('title')
    Strona główna
@endsection
@section('content')
    <section class="hidden lg:max-w-desktop lg:mx-auto lg:flex">
        <table class="w-full my-12">
            <thead class="bg-blue-600 text-white">
                <tr><th>Nr zamówienia</th><th>Opłacone</th><th>Odbiorca</th><th>Data złożenia zamówienia</th><th>Wysłane</th><th>Wartość</th></tr>
            </thead>
            <tbody class="pt-5">
                @foreach ($orders as $order)
                <tr class="text-center bg-white">
                    <td class="font-medium text-sky-700"><a href="{{ route('shpix.detail', $order) }}">{{ $order->id }}</a></td>
                    <td>
                        @if ($order->paid)
                        <i class="text-green-500 fa-sharp fa-solid fa-circle-check"></i></td>
                        @else
                        <i class="text-red-600 fa-sharp fa-solid fa-circle-xmark">
                        @endif
                    <td>
                    @php
                        $data = json_decode($order->customer);
                        
                        echo $data->firstname.' '.$data->lastname;
                    @endphp</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if ($order->shipped)
                        <i class="text-green-500 fa-sharp fa-solid fa-circle-check"></i>
                        @else
                        <i class="text-red-600 fa-sharp fa-solid fa-circle-xmark">
                        @endif
                    </td>
                    <td>
                    @php
                        if(isset($data->amount))
                           echo  $data->amount.' zł';
                        else
                       echo 'Nieopłacone';
                    @endphp
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </section>
    <div class="text-center text-sky-600 text-xl pt-12 lg:hidden">Ta strona nie wspiera urządzeń mobilnych.</div>
@endsection