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
    <style>
        .pusher {
            padding-top:100px
        }
        #ui-container {
            margin-top:-50px;
            padding-left: 10px;
            padding-right:10px
        }
    </style>
</head>
@yield('custom_css')
@php
    $original = explode(".", Request::route()->getName());
    
@endphp
<body>
    @include('layout.sidebar')
    <div class="pusher">
        <div class="ui" id="ui-container">
            <div class="ui breadcrumb" style="display:block">
                <a class="section">Home</a>
                <i class="right chevron icon divider"></i>
                @foreach ($original as $key => $name)
                    @if (($key+1) < count($original))
                        <a class="section">{{ ucwords($name) }}</a>    
                    @else
                        <i class="right arrow icon divider"></i>
                        <div class="active section">{{ ucwords($name) }}</div>
                    @endif
                @endforeach
                
                {{-- <i class="right arrow icon divider"></i> --}}
                {{-- <div class="active section">Personal Information</div> --}}
            </div>
            <div style="width:100%">
                @yield('main_content')
            </div>
        </div>
    </div>
</body>
</html>
@include('layout.foot')
@include('layout.jsinclude')
@yield('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        axios.defaults.baseURL = "{{ url('/') }}";
        localStorage.setItem('user', "{{ Auth::user()->id }}")
        // document.getElementById('toggle').onclick = function() {
        //     $('.main-sidebar')
        //     .sidebar({
        //           context: '.visible.example .bottom.segment'
        //     })
        //     .sidebar('hide');
        // }
        $('.main-sidebar').sidebar({
            dimPage: false,
            closable: false
        });
        $('.main-sidebar').sidebar('attach events', '.toggle');
    })
</script>