<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <title>Scheidt&bachmann</title>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        const banaskoRoute = "{{ route('banasko') }}";
    </script>
    <script src="{{ asset('js/mqtt.js') }}""></script>
    <style>
        :root {
            --primary-color: #1f2833;
            --secondary-color: #cfcfca;
            --terciary-color: #aed3ffee;
            --light-gray-color: #9c9a9a;

            --font-color-gray: #423f3f; 
            --font-color-darkblue: #1f2833;
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
            font-family: 'Montserrat', sans-serif; 
            font-weight: 400;
            line-height: 1.6;
        }
        
        a {
            color: inherit;
            text-decoration: none;
        }

        header {
            margin-bottom: 3rem;
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

        .nav-logo {
            height: 5rem;
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

        main {
            height: calc(100vh - 5rem - 2rem - 2rem - 3rem);
            padding-right: 3rem;
            padding-left: 3rem;
        }

        .heading-main {
            font-size: 4rem;
            letter-spacing: 0.45rem;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }

        .heading-secondary {
            font-size: 3.2rem;
            letter-spacing: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 300;
        }

        .main-content{
            display: flex;
            justify-content: space-between;
            gap: 10rem;
        }

        .main-content-left {
            flex-basis: 60%;
        }

        .main-content-right {
            flex-grow: 1;
        }

        .overview {
            height: 60rem;
            border-radius: 3px;
            padding: 3rem;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        }

        .parkingSlotsOverview {
            background-color: var(--terciary-color);
        }

        .parkedCarsOverview {
            background-color: var(--secondary-color);
        }

        .overviewItem {
            font-size: 4rem;
            color: var(--font-color-gray);
            border-bottom: 1px solid var(--light-gray-color);
        }

        .parkingSlot {
            display: flex;
            justify-content: space-between;
        }

        .overviewItem:not(:last-child) {
            margin-bottom: 2.5rem;
        }

        .occupied {
            color: #ce6139;
        }

        .free {
            color: #178b17;
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
                <a class="nav-list--item" href="{{ route('allowedCars') }}">Allowed Cars</a>
                <a class="nav-list--item" href="#">Modes</a>
                <a class="nav-list--item" href="#">Profile</a>
                <div class="nav-logout-item">
                    <a href="#">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <h1 class="heading-main">Parking house {{ucfirst($parkingHouse->name)}} in {{ucfirst($parkingHouse->location)}}</h1>
        <div class="main-content">
            <div class="main-content-left">
                <h2 class="heading-secondary">{{$slots->where('occupied', 0)->count()}}/{{$slots->count()}} free</h2>
                <div class="overview parkingSlotsOverview" @style(['overflow-y: scroll' => $slots->count() > 6])>
                    @foreach ($slots as $parkingSlot)
                        <div class="parkingSlot overviewItem" id="{{$parkingSlot->sensor->special_id}}">
                            <div class="parkingSlot--name">{{$parkingSlot->sensor->name}}</div>
                            <div @class(['parkingSlot--occupied', 'occupied' => $parkingSlot->occupied, 'free' => ! $parkingSlot->occupied]) class="">{{$parkingSlot->occupied == 1 ? "Occupied" : "Free"}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="main-content-right">
                <h2 class="heading-secondary">Mode: everyone</h2>
                <div class="overview parkedCarsOverview" @style(['overflow-y: scroll' => $parkedCars->count() > 6])>
                    @foreach ($parkedCars as $car)
                        <div class="parked-car overviewItem" id="{{$car->spz}}">
                            <div class="parked-car--id">{{$car->spz}}</div>
                        </div>
                    @endforeach
                </div>   
            </div>
        </div>
    </main>
</body>
</html>