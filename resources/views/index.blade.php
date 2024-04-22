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
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>Scheidt&bachmann</title>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        const banaskoRoute = "{{ route('banasko') }}";
    </script>
    <script src="{{ asset('js/mqtt.js') }}"></script>
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
    </header>
    <main>
        <h1 class="heading-main">Parking house {{ucfirst($parkingHouse->name)}} in {{ucfirst($parkingHouse->location)}}</h1>
        <div class="main-content">
            <div class="main-content-left">
                <h3 class="heading-tertiary">{{$slots->where('occupied', 0)->count()}}/{{$slots->count()}} free</h3>
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
                <h2 class="heading-tertiary">Mode: everyone</h2>
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
    <footer>
        <div>
            2024&copy; Made by Skibidi Marek and Mario
        </div>
    </footer>
    <script src="{{asset('js/index.js')}}"></script>
</body>
</html>