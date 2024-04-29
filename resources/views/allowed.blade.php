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
            <x-input id="form-input" class="allowed-input" type="text" name="spz" placeholder="ID"/>
            <x-submit-button id="submit-btn" class="car--addBtn">Add</x-submit-button>
        </div>
    </div>
    <div class="allowed-content--right">
        <x-overview id="cars" class="allowed-overview" :numOfElements="$cars->count()" maxElements='8'>
            @foreach ($cars as $car)
                <x-overview-item id="car-{{ $car->id }}" class="car" data-record-id="{{$car->id}}">
                    <div class="car--id">{{ $car->spz }}</div>
                    <x-delete-button class="car--deleteBtn" data-record-id="{{ $car->id }}">Delete</x-delete-button>
                </x-overview-item>
            @endforeach
        </x-overview>
    </div>
</x-content>
<script src="{{asset('js/allowed.js')}}"></script>
@endsection
