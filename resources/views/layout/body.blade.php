<div class="ui sidebar inverted vertical menu sidebar-menu" id="sidebar">
    <div class="item ">
        <div class="header">General</div>
        <div class="menu">
            <a class="item">
                <div><i class="icon tachometer alternate"></i>Dashboard</div>
            </a>
        </div>
    </div>

    <div class="item ">
        <div class="header">Administration</div>
        <div class="menu">
            <a href="#" class="item">
                <div><i class="icon users"></i>User</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>Registree</div>
            </a>
            <a href="#" class="item">
                <div><i class="icon users"></i>Division</div>
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
            EMB 8 PROCEDURES
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
            </div>
        </div>
    </div>
</nav>

<div class="pusher">
    <div class="main-content">
        <div class="content_header">
            <h1 class="header">{{ "Dashboard" }}</h1>
            <div class="ui divider"></div>
        </div>
        @yield('main_content')
    </div>
</div>