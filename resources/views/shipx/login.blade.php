@extends('layouts/shipx')
@section('title')
    Strona główna
@endsection
@section('content')
    <section class="lg:max-w-desktop lg:mx-auto">
        <div class="flex flex-col items-center">
            <h1 class="mt-12 text-4xl mb-5">Logowanie</h1>
            <form method="POST" action="{{ route('shipx.login') }}">
                @csrf
                <input name="login" value="{{ old('login') }}" placeholder="login" type="text" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1">
                <input name="password" placeholder="Hasło" type="password" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1">
                <input type="submit" value="Zaloguj" class="block bg-sky-600 mx-auto my-5 px-5 py-1 rounded-sm cursor-pointer shadow-sm text-white">
            </form>
            @if(Session::has('message'))
            <div class="text-red-600">{{ Session::get('message') }}</div>
            @endif
        </div>
    </section>
@endsection