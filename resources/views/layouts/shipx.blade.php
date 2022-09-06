<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/67499bc236.js" crossorigin="anonymous"></script>
</head>
<body class="flex flex-col">
    <nav class="block w-100 bg-blue-600 border-b-4 border-blue-700 py-3">
        <div class="flex justify-between items-center h-16 px-6 md:px-12 lg:max-w-desktop lg:mx-auto">
            <div class="text-white text-2xl font-bold"><a href="{{ route('shipx.home') }}">SHIPX</a></div>
            @if(!Session::has('isAdmin'))
            <a class="text-white" href="{{ route('shipx.login.view') }}">Zaloguj</a>
            @else
            <a class="text-white" href="{{ route('shipx.logout') }}">Wyloguj</a>
            @endif
        </div>
    </nav>
    <main class="block bg-slate-100">
        @yield('content')
    </main>
    <footer class="block w-100 bg-gray mt-6">
        <section class="block w-100 bg-slate-500 text-white text-center text-sm py-1">
            <div>Autor: Mateusz Wieczorek / mateusz.wieczorek429@gmail.com</div>
        </section>
    </footer>

</body>
</html>