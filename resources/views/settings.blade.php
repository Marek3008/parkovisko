@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endsection

@section('title', 'Settings')

@section('scripts')

@endsection

@section('headingMain')
Settings
@endsection

@section('content')
<x-content class="settings-content">
    <div class="content-left">
        <x-heading-tertiary>Sensors</x-heading-tertiary>
        <x-overview class="sensors-overview" numOfElements="{{$sensors->count()}}" maxElements="6">
            @foreach ($sensors as $sensor)
                <x-overview-item class="sensors-overview-item">
                    <div class="sensor-id">{{$sensor->special_id}}</div>
                    <div class="sensor-name">
                        <x-input class="sensor-name-input" name="sensorNameInput" placeholder="Name" value="{{ !is_null($sensor->name) ? $sensor->name : '' }}" />
                        <x-change-button>Change</x-change-button>
                    </div>
                </x-overview-item>
            @endforeach
        </x-overview>
    </div>
    <div class="content-right">
        <div class="modes">
            <x-heading-tertiary>Mode</x-heading-tertiary>
            <div class="selection-group">
                <select name="mode" class="selection input">
                    <option value="everyone" class="selection-option">Everyone</option>
                    <option value="only-allowed" class="selection-option">Only allowed</option>
                    <option value="opened-gate" class="selection-option">Opened gate</option>
                    <option value="close-gate" class="selection-option">Closed gate</option>
                </select><br>
                <x-change-button>Change</x-change-button>
            </div>
        </div>
        <div class="parkingHouses">
            <x-heading-tertiary>Parking House</x-heading-tertiary>
            <div class="selection-group">
                <select name="parkingHouse" class="selection input">
                    @foreach ($parkingHouses as $parkingHouse)
                        <option value="{{$parkingHouse->id}}" class="selection-option">{{$parkingHouse->name}} - {{ucfirst($parkingHouse->location)}}</option>
                    @endforeach
                </select><br>
                <x-change-button>Change</x-change-button>
            </div>
        </div>
    </div>
</x-content>
@endsection