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
    <script src="{{ url('plugins/docx-preview/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/docx-preview/docx-preview.js') }}"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head_js')
</head>
<style>
    /* Enhanced sidebar width control */
    #visibleSidebar {
        width: calc(100% - 260px);
        transition: all 0.3s ease;
    }

    #hiddenSidebar {
        width: 100%;
        transition: all 0.3s ease;
    }

    #custom-content {
        width: calc(100% - 260px);
        transition: all 0.3s ease;
    }

    /* Smooth body transitions */
    body {
        background: #f1f5f9;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        transition: background 0.3s ease;
    }

    /* Modern scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: #94a3b8;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #64748b;
    }

    /* Loading shimmer effect */
    .shimmer-loader {
        background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
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