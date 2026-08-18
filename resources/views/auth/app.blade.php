<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - MySystem</title>
<meta name="csrf-token" content="{{csrf_token()}}" />
<script src="{{ url('plugins/login/jquery.min.js.download') }}"></script>
<script src="{{ url('plugins/login/form.js.download') }}"></script>
<script src="{{ url('plugins/login/transition.js.download') }}"></script>
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
{{-- <link rel="stylesheet" href="{{ url('custom/css/custom-login-style.css') }}"> --}}
@vite('resources/css/custom-login-style.css')
<style>
  #loginSegment .ui.dimmer {
    background-color: rgba(0, 0, 0, 0.4);
  }
  #loginSegment {
    border: none !important;
    box-shadow: none !important;
  }
  
  #loginSegment .ui.dimmer.blinking {
    animation: blinkColors 1.2s infinite;
  }
  
  @keyframes blinkColors {
    0%   { background-color: rgba(120, 120, 120, 0.6); }  /* darker gray */
    50%  { background-color: rgba(200, 200, 200, 0.6); }  /* lighter gray */
    100% { background-color: rgba(120, 120, 120, 0.6); }
  }

  #loginSegment .ui.dimmer.success {
    background-color: rgba(0, 128, 0, 0.6);
    animation: none !important;
    /* animation: pulseGreen 1s infinite; */
  }

  #loginSegment .ui.dimmer.failure {
    background-color: rgba(200, 0, 0, 0.6) !important;
    animation: none !important;
  }
</style>
</head>
@include('layout.cssinclude')
<body>
    @yield('content')
    @include('layout.jsinclude')
    @vite(['resources/js/login/index.js'])
</body>
</html>