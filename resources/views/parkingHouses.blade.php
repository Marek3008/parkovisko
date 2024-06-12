@extends('layouts.app')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Parking houses')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/parkingHouses.css') }}">
@endsection

@section('headingMain', 'Parking houses')

@section('content')
<x-content class="houses-content">
    <div class="houses-content--left">
        <x-heading-tertiary>Add new parking house</x-heading-tertiary>
        <div id="popup-form" class="input-group">
            <x-input max="32" id="house-name-input" class="houses-input" type="text" name="name" placeholder="Name"/>
            <x-input max="100" id="house-location-input" class="houses-input" type="text" name="location" placeholder="Location"/><br>
            <x-submit-button id="submit-btn" class="house--addBtn">Add</x-submit-button>
        </div>
        <div id="error-container">

        </div>
    </div>
    <div class="houses-content--right">
        <x-overview id="houses" class="houses-overview" :numOfElements="$houses->count()" maxElements='8'>
            @foreach ($houses as $house)
                <x-overview-item id="house-{{ $house->id }}" class="house" data-record-id="{{$house->id}}">
                    <div class="house--id">{{$house->id}} {{ $house->name }} {{ $house->location}}</div>
                    <x-delete-button class="house--deleteBtn" data-record-id="{{ $house->id }}">Delete</x-delete-button>
                </x-overview-item>
            @endforeach
        </x-overview>
    </div>
</x-content>
<script src="{{asset('js/houses.js')}}"></script>
@endsection