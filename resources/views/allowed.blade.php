@extends('layouts.app')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Allowed cars')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/allowed.css') }}">
@endsection

@section('headingMain', 'Allowed cars')

@section('content')
<x-content class="allowed-content">
    <div class="allowed-content--left">
        <x-heading-tertiary>Add new allowed ID</x-heading-tertiary>
        <div id="popup-form" class="input-group">
            <input id="form-input" class="form-input" type="text" name="spz" placeholder="ID">
            <x-action-button id="submit-btn" class="submit-btn">Add</x-action-button>
        </div>
    </div>
    <div class="allowed-content--right">
        <x-overview id="cars" class="allowed-overview" :numOfElements="$cars->count()" maxElements='8'>
            @foreach ($cars as $car)
                <div id="car-{{ $car->id }}" class="car allowed-overview-item" data-record-id="{{$car->id}}">
                    <div class="car--id">{{ $car->spz }}</div>
                    <x-action-button class="delete-btn car--deleteBtn" data-record-id="{{ $car->id }}">Delete</x-action-button>
                </div>
            @endforeach
        </x-overview>
    </div>
</x-content>
<script src="{{asset('js/allowed.js')}}"></script>
@endsection
