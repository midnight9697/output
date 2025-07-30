@php
    $routesplit = explode(".", Request::route()->getName());
@endphp
<div class="ui sidebar very wide inverted vertical menu sidebar-menu" id="sidebar">
    <div class="item">
        <div class="header">General</div>
        <div class="menu">
            <a href="{{ route('main') }}" class="item">
                <div><i class="icon tachometer alternate"></i>Dashboard</div>
            </a>
            <a href="{{ url('pr') }}" class="item">
                <div><i class="icon users"></i>Purchase Request</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>APP</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>PPMP</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>Supplemental</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>RFQ</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>Purchase Order</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>Abstract</div>
            </a>
            
        </div>
    </div>

    <div class="item ">
        <div class="header">Administration</div>
        <div class="menu">
            <a href="{{ url('users') }}" class="item {{ in_array("user"||"users", $routesplit)?"active":"" }}">
                <div>
                    <i class="icon users"></i>User
                </div>
            </a>
            {{-- <a href="#" class="item">
                <div><i class="icon users"></i>Registree</div>
            </a> --}}
            <a href="http://notices.ps-philgeps.gov.ph" target="__blank" class="item">
                <div><i class="icon users"></i>PhilGeps</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>Division</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>BAC</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>Inspector</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>RA 9184</div>
            </a>
        </div>
    </div>
</div>

{{-- Top Inverted Menu --}}
<nav class="ui top fixed inverted menu">
    <div class="left menu">
        <a href="#" class="sidebar-menu-toggler item" data-target="#sidebar">
            <i class="sidebar icon"></i>
        </a>
        <a href="#" class="header item">
            EMB 8 PROCUREMENT SYSTEM
        </a>
    </div>
    <div class="right menu">
        <a href="#" class="item">
            <i class="bell icon"></i>
        </a>
        <div class="ui dropdown item">
            <i class="user circle icon"></i>
            <div class="menu">
                <a href="#" class="item">
                    <i class="info circle icon"></i> Profile
                </a>
                <a href="#" class="item" id="logout_user">
                    <i class="power off icon"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="pusher">
    <div class="main-content" style="padding:40px">
        <div class="content_header">
            <h1 class="header">
                @php
                    $name = str_replace(".", " ", strtoupper(Request::route()->getName()));
                    echo $name;
                @endphp
            </h1>
            @yield('extra_content')
            <div class="ui divider"></div>
        </div>
        <div class="ui segment" id="main_event">
            @include('default.loader')
            {{-- <div id=""> --}}
                @yield('main_content')
            {{-- </div> --}}
        </div>
    </div>
</div>