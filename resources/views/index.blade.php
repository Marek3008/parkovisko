<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Scheidt&bachmann</title>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        banaskoRoute = "{{ route('banasko') }}";
    </script>
    <script src="{{ asset('js/mqtt.js') }}""></script>
</head>
<body>
    <nav>
        <a href="#">DASHBOARD</a>
        <a href="#">ALLOWED CARS</a>
        <a href="#">CURRENTLY PARKED CARS</a>
        <a href="#">MODES</a>
    </nav>

    <div class="parkovisko" style="display: flex; justify-content: space-around;">
        @foreach ($slots as $slot)
            <div id="{{$slot->sensor->special_id}}">
                <p>{{$slot->occupied == 1 ? "obsadené" : "voľné"}}</p>
            </div>
        @endforeach
    </div>
</body>
</html>