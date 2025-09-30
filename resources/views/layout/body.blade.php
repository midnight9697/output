@php
    use Illuminate\Support\Facades\Gate;
    $routesplit = explode(".", Request::route()->getName());
@endphp
<div class="ui visible sidebar vertical left inverted  menu main-sidebar" id="sidebar">
    <div class="item">
        <div class="sixteen wide column">
          <img src="{{ url('files/images/emb.png') }}" class="ui very tiny circular image centered">
        </div>
        <div class="content" style="text-align: center">
          <span class="header">{{ Auth::user()->full_name }}</span>
          {{-- <div class="meta">
            <span class="date">{{ Auth::user()->full_name }}</span>
          </div> --}}
          <div class="description">
            {{ Auth::user()->profile->position }}
          </div>
        </div>
    </div>
    <div class="item">
        <div class="header">General</div>
        <div class="menu">
            {{ view('layout.menu', [ 'url' => route('home'), 'title' => 'Dashboard', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('pr'), 'title' => 'Purchase Request', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'APP', 'routesplit' => $routesplit, 'permission' => (Auth::user()->profile->unit_id == 1)]) }}
            {{ view('layout.menu', [ 'url' => url('ppmp'), 'title' => 'PPMP', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('supplemental'), 'title' => 'Supplemental', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('rfq'), 'title' => 'RFQ', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('purchase_order'), 'title' => 'Purchase Order', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('abstract'), 'title' => 'Abstract', 'routesplit' => $routesplit, 'permission' => true]) }}
        </div>
    </div>
    
    <div class="item ">
        <div class="header">Administration</div>
        <div class="menu">
            {{ view('layout.menu', [ 'url' => url('users'), 'title' => 'Users', 'routesplit' => $routesplit , 'permission' => Gate::allows('user-view-page')]) }}
            {{ view('layout.menu', [ 'url' => "http://notices.ps-philgeps.gov.ph", 'title' => 'PhilGeps', 'routesplit' => $routesplit, 'permission' => true,'target' => true]) }}
            {{ view('layout.menu', [ 'url' => "division", 'title' => 'Division', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "bac", 'title' => 'BAC', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "inspector", 'title' => 'Inspector', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "https://r8.emb.gov.ph/wp-content/uploads/2025/02/EMB8-Citizens-Charter-External-Internal-Service-2025-Edition-portrait-1.pdf", 'title' => 'RA 9184', 'routesplit' => $routesplit, 'permission' => true]) }}
        </div>
    </div>
</div>

{{-- Top Inverted Menu --}}
<nav class="ui basic icon top fixed menu custom-topbar">
    <a class="item toggle button">
        <i class="sidebar icon"></i>
        Menu
    </a>
    <div class="left menu">
        <a href="" class="item">
            @php
                $name = str_replace(".", " ", strtoupper(Request::route()->getName()));
                echo $name;
            @endphp
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
    {{-- <div id="holloween">
        <img src="{{ url('files/can.gif') }}" alt="" width="100" height="100" id="image_holoween">
    </div> --}}
</nav>

<div class="pusher">
    <div class="custom-content" id="custom-content" style="padding:40px;">
        <div class="content_header">
            {{-- <h1 class="header">
                @php
                    $name = str_replace(".", " ", strtoupper(Request::route()->getName()));
                    echo $name;
                @endphp
            </h1> --}}
            @yield('extra_content')
            {{-- <div class="ui divider"></div> --}}
        </div>
        <div class="ui segment" id="main_event">
                <div class="ui segment" style="overflow: hidden;display:none" id="pageLoaderDefault">
                    <div class="ui active inverted dimmer">
                      <div class="ui large text loader">Loading</div>
                    </div>
                    <p style="height:12px;background:grey;width:100%" class="disabled initia_loader"></p>
                      <p style="height:12px;background:grey;width:100%" class="disabled initia_loader"></p>
                      <p style="height:12px;background:grey;width:100%" class="disabled initia_loader"></p>
                      <p style="height:12px;background:grey;width:100%" class="disabled initia_loader"></p>
                      <p style="height:12px;background:grey;width:100%" class="disabled initia_loader"></p>
                      <p style="height:12px;background:grey;width:100%" class="disabled initia_loader"></p>
                </div>
                <div id="body_content_default">
                    
                    @include('default.loader')
                    @yield('main_content')
                </div>
            </div>
        </div>
    </div>

</div>



<style>
    #holloween {
        position: fixed;
        z-index: 10;
        right:0px;
        /* display: none; */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        var holloween = document.getElementById('holloween');
        var custom_topbar = document.getElementsByClassName('custom-topbar')[0];
        var image_holoween = document.getElementById('image_holoween');
        let start = (custom_topbar.offsetWidth - 100);
        let vertical_start = 0;
        let max_travel = (custom_topbar.offsetWidth - 100);
        let max_height = (window.innerHeight - 100);
        let movement = "left";

        setInterval(() => {
            movement = (start == max_travel?"left":movement);
            movement = (start == 0?"down":movement);
            movement = (start == 0 && vertical_start == max_height?"right":movement);
            movement = (start == max_travel && vertical_start >=   ?"up":movement);
            console.log('start - vertical', start, vertical_start, movement);
            switch (movement) {
                case "left":
                        image_holoween.style.transform = "";
                        start -= 1;
                    break;
                case "down":
                        image_holoween.style.transform = "";
                        vertical_start += 1;
                    break;
                 case "up":
                        image_holoween.style.transform = "";
                        vertical_start -= 1;
                    break;
                default:
                        image_holoween.style.transform = "scaleX(-1)";
                        image_holoween.style.transform = "-webkit-transform: scaleX(-1)";
                        start += 1;
                    break;
            }
            holloween.style.left= start+"px";
            holloween.style.top = vertical_start+"px";
        }, 1);
    });

    function original() {
        var holloween = document.getElementById('holloween');
        var custom_topbar = document.getElementsByClassName('custom-topbar')[0];
        var image_holoween = document.getElementById('image_holoween');
        let start = (custom_topbar.offsetWidth - 100);
        let max_travel = (custom_topbar.offsetWidth - 100);
        let max_height = screen.height;
        let movement = "left";
        console.log('height', max_height);
        setInterval(() => {
            movement = (start == max_travel?"left":movement);
            movement = (start == 0?"right":movement);
            switch (movement) {
                case "left":
                        image_holoween.style.transform = "";
                        start -= 1;
                    break;
                default:
                        image_holoween.style.transform = "scaleX(-1)";
                        image_holoween.style.transform = "-webkit-transform: scaleX(-1)";
                        start += 1;
                    break;
            }
            holloween.style.left= start+"px";
        }, 10);
    }
</script>