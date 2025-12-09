@extends('layout.app')

@section('head_js')
    @vite(['resources/js/home.js'])
@endsection

@section('main_content')
    @include('admin.home.grid', [ 'count_user' => $count_user, 'count_supplier' => $count_supplier, 'count_pr' => $count_pr, 'count_rfq' => $count_rfq ])
    @include('admin.home.supplier-map')
@endsection
@section('custom_js')
    <script async defer src="{{env('MARCO_MAP_API')}}&callback=initMap"></script>
    <script>
        localStorage.setItem('asset', "{{ asset('mapicon.png') }}");
    </script>
@endsection