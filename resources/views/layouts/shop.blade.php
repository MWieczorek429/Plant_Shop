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
    <nav class="block w-100 bg-green border-b-4 border-green-light py-3">
        <div class="flex justify-between items-center h-16 px-6 md:px-12 lg:max-w-desktop lg:mx-auto">
            <div class="text-white text-2xl font-bold"><a href="{{ route('home') }}">GREEN HOUSE</a></div>
            <a href="{{ route('cart') }}" class="flex content-center mt-2">
                <i class="fa-solid fa-cart-shopping text-2xl text-white"></i>
                <span class="text-white text-decoration-none pt-2 "> ({{ Session::has('cart') ? Session::get('cart')->totalQuantity : '0' }})</span>
            </a>
        </div>
    </nav>
    <main class="block">
        @yield('content')
    </main>
    <footer class="block w-100 bg-gray mt-6">
        <div class="flex flex-wrap text-white px-6 py-6 md:px-12 lg:max-w-desktop lg:mx-auto">
            <div class="mr-14">
                <span class="font-bold text-base">Kontakt</span>
                <ul class="text-sm text-gray-200">
                    <li class="py-1"><i class="fa-solid fa-phone pr-2"></i>   +48 660 456 789</li>
                    <li class="py-1"><i class="fa-solid fa-envelope pr-2"></i>  mateusz.wieczorek429@gmail.com</li>
                    <li class="py-1"><i class="fa-solid fa-clock pr-2"></i>pon. - pt. 8:00 - 16:00</li>
                </ul>
            </div>
            <div class="mt-6 sm:mt-0 sm:float-left">
                <span class="font-bold text-base">O nas</span>
                <ul class="text-sm text-gray-200">
                    <li class="py-1 hover:text-gray-400"><a href="#">Regulamin</a></li>
                    <li class="py-1 hover:text-gray-400"><a href="#">Polityka prywatności</a></li>
                    <li class="py-1 hover:text-gray-400"><a href="#">Polityka cookies</a></li>
                </ul>
            </div>
        </div>
        <section class="block w-100 bg-slate-500 text-white text-center text-sm py-1">
            <div>Autor: Mateusz Wieczorek / mateusz.wieczorek429@gmail.com</div>
        </section>
    </footer>

</body>
</html>