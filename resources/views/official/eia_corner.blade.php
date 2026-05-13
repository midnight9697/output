<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIMS Dashboard</title>
    @include('layout.cssinclude')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ url('custom/css/customize-style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head_js')
</head>
@yield('custom_css')
<body id="main_event">
    @yield('main_content')
</body>
</html>
@include('layout.jsinclude')
@yield('custom_js')