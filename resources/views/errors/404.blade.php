@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', 'Oops!')
@section('message', __('Halaman tidak ditemukan!'))

@section('image')
    <div class="mb-3">
        <img src="{{asset('assets/media/graphics/404.png')}}" class="mw-100 mh-300px theme-light-show" alt="" />
        <img src="{{asset('assets/media/graphics/404-dark.png')}}" class="mw-100 mh-300px theme-dark-show" alt="" />
    </div>
@endsection
