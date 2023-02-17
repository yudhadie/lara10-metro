@extends('admin.templates.default')

@section('content')


@endsection

@section('styles')

@endsection

@push('scripts')

    <script>
        var element = document.getElementById('menu-dashboard');
            element.classList.add('active');
    </script>

@endpush
