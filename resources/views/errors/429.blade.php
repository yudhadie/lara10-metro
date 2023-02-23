@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))

@section('image')
    <div class="mb-3">
        <img src="{{asset('assets/media/graphics/error.png')}}" class="mw-100 mh-300px theme-light-show" alt="" />
        <img src="{{asset('assets/media/graphics/error-dark.png')}}" class="mw-100 mh-300px theme-dark-show" alt="" />
    </div>
@endsection
