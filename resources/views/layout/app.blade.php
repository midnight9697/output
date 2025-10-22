<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>PROCUREMENT SYSTEM</title>
    @include('layout.cssinclude')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="{{ url('plugins/quill/quill.snow.css') }}" rel="stylesheet">
    <link rel="icon" href="{{asset('emb_logo.png')}}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    #visibleSidebar {
        width: calc(100% - 260px);
    }

    #hiddenSidebar {
        width: 100%;
    }

    #custom-content {
        width: calc(100% - 260px);
    }
</style>
@yield('custom_css')
<body>
    @include('layout.head')
    @include('layout.body')
    @include('layout.foot')
</body>
</html>
@include('layout.jsinclude')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="{{ url('plugins/quill/quill.js') }}"></script>
<script>
    axios.defaults.baseURL = "{{ url('/') }}";
    localStorage.setItem('user', "{{ Auth::user()->id }}")
    
    if ($('.main-sidebar').sidebar('is visible')) {
        document.getElementsByClassName('custom-content')[0].id = "visibleSidebar";
        document.getElementsByClassName('custom-topbar')[0].id = "visibleSidebar";
    }

    $('.main-sidebar').sidebar({
            dimPage: false,
            closable: false,
            onVisible: () => {
                document.getElementsByClassName('custom-content')[0].id = "visibleSidebar";
                document.getElementsByClassName('custom-topbar')[0].id = "visibleSidebar";
            },
            onHidden: () => {
                document.getElementsByClassName('custom-content')[0].id = "hiddenSidebar";
                document.getElementsByClassName('custom-topbar')[0].id = "hiddenSidebar";
            }
        }).sidebar('show');
        $('.main-sidebar').sidebar('attach events', '.toggle');
</script>
@yield('custom_js')