@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))

@section('image')
    <div class="mb-3">
        <img src="{{asset('assets/media/graphics/503.png')}}" class="mw-100 mh-300px theme-light-show" alt="" />
        <img src="{{asset('assets/media/graphics/503-dark.png')}}" class="mw-100 mh-300px theme-dark-show" alt="" />
    </div>
@endsection
