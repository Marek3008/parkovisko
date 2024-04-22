<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="{{ asset('js/allowed.js') }}"></script>
</head>
<body>
    <button id="add-btn" onclick="addForm()">add</button>
    <div class="content">
        
        @foreach ($cars as $car)
            <div id="car-{{ $car->id }}" style="display: flex">
                <div>{{ $car->spz }}</div>
                <button class="delete-btn" style="margin-left: 10px" data-record-id="{{ $car->id }}">delete</button>
            </div>
        @endforeach
    </div>
    
</body>
</html>