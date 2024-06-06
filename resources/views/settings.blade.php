@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Settings')



@section('headingMain')
Settings
@endsection

@section('content')
<x-content class="settings-content">
    <div class="content-left">
        <div class="heading-container">
            <x-heading-tertiary>Sensors</x-heading-tertiary>
            <div id="error-container"></div>
        </div>
        <x-overview id="sensors" class="sensors-overview" numOfElements="{{$sensors->count()}}" maxElements="6">
            @foreach ($sensors as $sensor)
                <x-overview-item class="sensors-overview-item">
                    <div class="sensor-id">{{$sensor->special_id}}</div>
                    <div class="sensor-name">
                        <x-input id="sensor-{{ $sensor->id }}" class="sensor-name-input" name="sensorNameInput" placeholder="Name" value="{{ !is_null($sensor->name) ? $sensor->name : '' }}" />
                        <x-change-button btn-id="{{ $sensor->id }}">Change</x-change-button>
                    </div>
                </x-overview-item>
            @endforeach
        </x-overview>
    </div>
    <div class="content-right">
        <div class="modes">
            <x-heading-tertiary>Mode</x-heading-tertiary>
            <div class="selection-group">
                <select id="mode" name="mode" class="selection input">
                    <option @selected($currentHouse->mode == "everyone") value="everyone" class="selection-option">Everyone</option>
                    <option @selected($currentHouse->mode == "allowed") value="allowed" class="selection-option">Only allowed</option>
                    <option @selected($currentHouse->mode == "open") value="open" class="selection-option">Opened gate</option>
                    <option @selected($currentHouse->mode == "closed") value="closed" class="selection-option">Closed gate</option>
                </select><br>
                <x-change-button id="change-button">Change</x-change-button>
            </div>
        </div>
        <div class="parkingHouses">
            <x-heading-tertiary>Parking House</x-heading-tertiary>
            <div class="selection-group">
                <form action="{{route('change-parking-house')}}" method="POST">
                    @csrf
                    <select name="parkingHouse" class="selection input" id="parkingHouse">
                        @foreach ($parkingHouses as $parkingHouse)
                            <option @selected($parkingHouse->id == session('parkingHouse')) value="{{$parkingHouse->id}}" class="selection-option">{{$parkingHouse->name}} - {{ucfirst($parkingHouse->location)}}</option>
                        @endforeach
                    </select><br>
                    <x-change-button>Change</x-change-button>
                </form>
            </div>
        </div>
    </div>
</x-content>
<script src="{{ asset('js/settings.js') }}"></script>
@endsection