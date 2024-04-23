<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    @yield('styles', '')

    <title>@yield('title') | Parksy</title>

    @yield('scripts', '')
</head>
<body>
    <header>
        <nav class="nav">
            <div class="nav-logo">
                <img class="nav-logo--img" src="{{ asset('img/logo_white.png') }}" alt="Logo">
            </div> 
            <div class="mobile-nav">
                <div class="mobile-nav-container">
                    <div class="mobile-nav-btn mobile-nav-btn--first"></div>
                    <div class="mobile-nav-btn mobile-nav-btn--middle"></div>
                    <div class="mobile-nav-btn mobile-nav-btn--last"></div>
                </div>
            </div>
            <div class="nav-list">
                <a class="nav-list--item" href="#">Dashboard</a>
                <a class="nav-list--item" href="{{ route('allowedCars') }}">Allowed Cars</a>
                <a class="nav-list--item" href="#">Modes</a>
                <a class="nav-list--item" href="#">Profile</a>
                <a class="nav-list--item" href="#">Logout</a>
            </div>
        </nav>
        <script src="{{asset('js/nav.js')}}"></script>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div>
            2024&copy; Made by Skibidi Marek and Mario
        </div>
    </footer>
</body>
</html>