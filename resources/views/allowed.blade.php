@extends('layouts.app')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Allowed cars')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/allowed.css') }}">
@endsection

@section('headingMain')
Allowed cars
@endsection


@section('content')
<div class="allowed-content">
    <div class="allowed-content--left">
        <div id="popup-form" class="input-group">
            <h3 for="form-input" class="heading-tertiary">Add new allowed ID</h3>
            <div class="input-group--control-group">
                <input id="form-input" class="form-input" type="text" name="spz" placeholder="ID">
                <button id="submit-btn" class="btn submit-btn">Add</button>
            </div>        
        </div>
    </div>
    <div class="allowed-content--right">
        <div id="cars" class="allowed-overview" @style(['overflow-y: scroll' => $cars->count() > 7])>
            @foreach ($cars as $car)
                <div id="car-{{ $car->id }}" class="car allowed-overview-item" data-record-id="{{$car->id}}">
                    <div class="car--id">{{ $car->spz }}</div>
                    <button class="delete-btn btn car--deleteBtn" data-record-id="{{ $car->id }}">Delete</button>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script src="{{asset('js/allowed.js')}}"></script>
@endsection
