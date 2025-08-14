<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>PROCUREMENT SYSTEM</title>
    @include('layout.cssinclude')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@yield('custom_css')
<body>
    @include('layout.head')
    @include('layout.body')
    
    @include('layout.foot')
</body>
</html>
@include('layout.jsinclude')
<script>
    axios.defaults.baseURL = "{{ url('/') }}";
    localStorage.setItem('user', "{{ Auth::user()->id }}")
</script>
@yield('custom_js')