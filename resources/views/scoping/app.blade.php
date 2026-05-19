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
    <style>
      .ui.selection.dropdown {
        /* position: relative; */
        z-index: 10;
      }

      .ui.selection.dropdown.active {
        z-index: 100;
      }
    </style>
</head>
<body>
    @yield('custom_css')
    @yield('content')
    @include('layout.jsinclude')
    <link rel="stylesheet" href="{{ url('custom/css/custom-crud-style.css') }}">
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        axios.defaults.baseURL = "{{ url('/') }}";
      });
    </script>
    @yield('custom_js')
</body>
</html>