@extends('errors.minimal')

@section('title', __('User Disabled'))
@section('code', 'User Disabled')
@section('message', __('Silahkan Hubungi Administrator!'))

@section('image')
    <div class="mb-3">
        <img src="{{asset('assets/media/graphics/closed.png')}}" class="mw-100 mh-300px theme-light-show" alt="" />
        <img src="{{asset('assets/media/graphics/closed-dark.png')}}" class="mw-100 mh-300px theme-dark-show" alt="" />
    </div>
    <div class="mb-3">
        <a href="{{ route('logout') }}"
            class="btn btn-sm btn-danger"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();
            ">
            Sign Out
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
@endsection
