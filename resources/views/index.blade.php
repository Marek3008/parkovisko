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
<x-content>
    <div class="main-content-left">
        <x-heading-tertiary class="freeSlotsCount">{{$slots->where('occupied', 0)->count()}}/{{$slots->count()}} free</x-heading-tertiary>
        <x-overview class="parkingSlotsOverview" numOfElements="{{$slots->count()}}" maxElements="6">
            @foreach ($slots as $parkingSlot)
                <div class="parkingSlot overviewItem" id="{{$parkingSlot->sensor->special_id}}">
                    <div class="parkingSlot--name">{{$parkingSlot->sensor->name}}</div>
                    <div @class(['parkingSlot--occupied', 'occupied' => $parkingSlot->occupied, 'free' => ! $parkingSlot->occupied])>{{$parkingSlot->occupied == 1 ? "Occupied" : "Free"}}</div>
                </div>
            @endforeach
        </x-overview>
    </div>
    <div class="main-content-right">
        <x-heading-tertiary>Mode: everyone</x-heading-tertiary>
        <x-overview class="parkedCarsOverview" :numOfElements="$parkedCars->count()" maxElements="6">
            @foreach ($parkedCars as $car)
                <div class="parked-car overviewItem" id="{{$car->spz}}">
                    <div class="parked-car--id">{{$car->spz}}</div>
                </div>
            @endforeach
        </x-overview>   
    </div>
</x-content>
<script src="{{ asset('js/index.js') }}"></script>
@endsection
        