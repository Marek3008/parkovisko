<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta', '')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    @yield('styles', '')

    <title>@yield('title') | Parksy</title>

    @yield('scripts', '')
</head>
<body>
    <header>
        <x-nav/>
    </header>
    <main>
        <h1 class="heading-main">@yield('headingMain')</h1>
        @yield('content')
    </main>
    <footer>
        <div>
            2024&copy; Made by Skibidi Marek and Mario
        </div>
    </footer>
</body>
</html>