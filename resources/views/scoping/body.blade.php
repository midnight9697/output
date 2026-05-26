@php
    use Illuminate\Support\Facades\Gate;
    $routesplit = explode(".", Request::route()->getName());
@endphp
@php
    use App\Models\PurchaseRequest;
    use App\Models\Recepient;
    use App\Models\RFQ;
    use App\Models\Supplier;
    use App\Models\User;
    
    $count_user = User::count();
    $count_supplier = Supplier::count();
    $count_pr = PurchaseRequest::where('created_by', Auth::user()->id)->count();
    $count_pr_inbox = Recepient::where('receiver_id', Auth::user()->id)->where('received', '0')->count();
    $count_rfq = RFQ::where('creator', Auth::user()->id)->count();
@endphp
<div class="ui visible sidebar vertical left inverted  menu main-sidebar" id="sidebar" style="background: #2C468C">
    <div class="item" style="background: rgba(255, 255, 255, 0.6)">
        <div class="sixteen wide column">
          <img src="{{ url('files/images/pims_2.png') }}" class="ui very tiny image centered" style="width: 400px;">
        </div>
        <div class="content" style="text-align: center;">
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
            {{ view('layout.menu', ['badge' => $count_pr_inbox,  'url' => url('pr'), 'title' => 'Purchase Request', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{-- {{ view('layout.menu', [ 'url' => url('#'), 'title' => 'APP', 'routesplit' => $routesplit, 'permission' => (Auth::user()->profile->unit_id == 1)]) }} --}}
            {{ view('layout.menu', [ 'url' => url('app'), 'title' => 'APP', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
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
                <a href="{{ url('users/'.(encryptUrlSafe(Auth::user()->id)).'/edit') }}" class="item">
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
        var custom_topbar = document.getElementsByClassName('custom-topbar')[0];
        let start = (custom_topbar.offsetWidth - 100);
        let vertical_start = 0;
        let max_travel = (custom_topbar.offsetWidth - 100);
        let max_height = (window.innerHeight - 100);
        let movement = "left";
    });

</script>