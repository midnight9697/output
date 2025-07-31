@php
    use Illuminate\Support\Facades\Gate;
    $routesplit = explode(".", Request::route()->getName());
@endphp
<div class="ui sidebar very wide inverted vertical menu sidebar-menu" id="sidebar">
    <div class="item">
        <div class="header">General</div>
        <div class="menu">
            {{ view('layout.menu', [ 'url' => url('main'), 'title' => 'Dashboard', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('pr'), 'title' => 'Purchase Request', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'APP', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'PPMP', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'Supplemental', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'RFQ', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'Purchase Order', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'Abstract', 'routesplit' => $routesplit, 'permission' => true]) }}
        </div>
    </div>

    <div class="item ">
        <div class="header">Administration</div>
        <div class="menu">
            {{ view('layout.menu', [ 'url' => url('users'), 'title' => 'Users', 'routesplit' => $routesplit , 'permission' => Gate::allows('user-view-page')]) }}
            {{ view('layout.menu', [ 'url' => "http://notices.ps-philgeps.gov.ph", 'title' => 'PhilGeps', 'routesplit' => $routesplit, 'permission' => true,'target' => true]) }}
            {{ view('layout.menu', [ 'url' => "#", 'title' => 'Division', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "#", 'title' => 'BAC', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "#", 'title' => 'Inspector', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "#", 'title' => 'RA 9184', 'routesplit' => $routesplit, 'permission' => true]) }}
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
                <a href="{{ url('users/'.Auth::user()->id.'/edit') }}" class="item">
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