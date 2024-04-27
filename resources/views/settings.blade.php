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
<x-content>
    <div class="content-left">
        <x-heading-tertiary>Sensors</x-heading-tertiary>
        <x-overview class="sensors-overview" numOfElements="{{$sensors->count()}}" maxElements="6">
            @foreach ($sensors as $sensor)
                <x-overview-item>
                    <div class="sensor-id">{{$sensor->special_id}}</div>
                    <div class="sensor-name">
                        <x-input class="sensor-name-input" name="sensorNameInput" placeholder="Name" value="{{ !is_null($sensor->name) ? $sensor->name : '' }}" />
                        <x-button class="sensor-name-button">Change</x-button>
                    </div>
                </x-overview-item>
            @endforeach
        </x-overview>
    </div>
    <div class="content-right">
        <div class="modes">
            <x-heading-tertiary>Mode:</x-heading-tertiary>
            <div class="selection-group">
                <select name="mode" class="mode-selection form-input">
                    <option value="everyone" class="mode-selection-option">Everyone</option>
                    <option value="only-allowed" class="mode-selection-option">Only allowed</option>
                    <option value="opened-gate" class="mode-selection-option">Opened gate</option>
                    <option value="close-gate" class="mode-selection-option">Closed gate</option>
                </select><br>
                <x-button>Change</x-button>
            </div>
        </div>
    </div>
</x-content>
@endsection