@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('title', 'Home')

@section('scripts')
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        const parkingSlotsRoute = "{{ route('requestParkingSlots') }}";
        const parkedCarsRoute = "{{ route('requestParkedCars') }}";
        const topicsArray = ['banasko/zmena'];
    </script>
    <script src="{{ asset('js/mqtt.js') }}"></script>
@endsection

@section('headingMain')
Parking house {{ucfirst($parkingHouse->name)}} in {{ucfirst($parkingHouse->location)}}
@endsection

@section('content')
<div class="main-content">
    <div class="main-content-left">
        <h3 class="heading-tertiary freeSlotsCount">{{$slots->where('occupied', 0)->count()}}/{{$slots->count()}} free</h3>
        <div class="overview parkingSlotsOverview" @style(['overflow-y: scroll' => $slots->count() > 6])>
            @foreach ($slots as $parkingSlot)
                <div class="parkingSlot overviewItem" id="{{$parkingSlot->sensor->special_id}}">
                    <div class="parkingSlot--name">{{$parkingSlot->sensor->name}}</div>
                    <div @class(['parkingSlot--occupied', 'occupied' => $parkingSlot->occupied, 'free' => ! $parkingSlot->occupied])>{{$parkingSlot->occupied == 1 ? "Occupied" : "Free"}}</div>
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
<script src="{{ asset('js/index.js') }}"></script>
@endsection
        