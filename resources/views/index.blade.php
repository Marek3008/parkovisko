<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <title>Scheidt&bachmann</title>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        const banaskoRoute = "{{ route('banasko') }}";
    </script>
    <script src="{{ asset('js/mqtt.js') }}""></script>
    <style>
        :root {
            --primary-color: #1f2833;
            --secondary-color: #b69b04;

            --font-color-gray: #423f3f; 
            --font-color-blue: #66fcf1;
            --font-color-white: #eee;
        }
        * {
            margin: 0;  
            padding: 0;
        }  

        *,
        *::after,
        *::before {
            box-sizing: inherit;
        }

        html {
            box-sizing: border-box;
            font-size: 62.5%; // 1rem == 10px
        }

        body {
            font-family: 'Open Sans', sans-serif; 
            font-weight: 400;
            line-height: 1.6;
        }
        
        a {
            color: inherit;
            text-decoration: none;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            padding-left: 3rem;
            padding-right: 3rem;
            font-size: 1.9rem;
            background-color: var(--primary-color);
            color: var(--font-color-white);
        }

        .nav-logo--img {
            height: 5rem;
        }

        .nav-list {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 6rem;
            /* margin-right: 10rem; */
        }

    </style>
</head>
<body>
    <header>
        <nav class="nav">
            <div class="nav-logo">
                <img class="nav-logo--img" src="{{ asset('img/logo_white.png') }}" alt="Logo">
            </div> 
            <div class="nav-list">
                <a class="nav-list--item" href="#">Dashboard</a>
                <a class="nav-list--item" href="#">Allowed Cars</a>
                <a class="nav-list--item" href="#">Modes</a>
                <a class="nav-list--item" href="#">Users</a>
                <div class="nav-logout-item">
                    <a href="#">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="parkovisko" style="display: flex; justify-content: space-around;">
            @foreach ($slots as $slot)
                <div id="{{$slot->sensor->special_id}}">
                    <p>{{$slot->occupied == 1 ? "obsadené" : "voľné"}}</p>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>