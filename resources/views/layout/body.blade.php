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

{{-- Sidebar --}}
<div class="ui visible sidebar vertical left inverted menu main-sidebar" id="sidebar">
    {{-- Sidebar decorative accent --}}
    <div class="sidebar-accent-top"></div>
    
    {{-- User Profile Section --}}
    <div class="item sidebar-profile">
        <div class="sixteen wide column">
            <img src="{{ url('files/images/pims_2.png') }}" class="ui very tiny image centered sidebar-logo">
        </div>
        <div class="content" style="text-align: center; margin-top: 5px;">
            <span class="header sidebar-username">{{ Auth::user()->full_name }}</span>
            <div class="description sidebar-user-role">
                {{ Auth::user()->profile->position ?? 'Staff' }}
            </div>
        </div>
    </div>

    {{-- General Menu --}}
    <div class="item sidebar-section">
        <div class="header sidebar-section-header">General</div>
        <div class="menu">
            {{ view('layout.menu', [ 'url' => route('home'), 'title' => 'Dashboard', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', ['badge' => $count_pr_inbox,  'url' => url('pr'), 'title' => 'Purchase Request', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('app'), 'title' => 'APP', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
            {{ view('layout.menu', [ 'url' => url('ppmp'), 'title' => 'PPMP', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => url('supplemental'), 'title' => 'Supplemental', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
            {{ view('layout.menu', [ 'url' => url('rfq'), 'title' => 'RFQ', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
            {{ view('layout.menu', [ 'url' => url('purchase_order'), 'title' => 'Purchase Order', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
            {{ view('layout.menu', [ 'url' => url('abstract'), 'title' => 'Abstract', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
        </div>
    </div>
    
    {{-- Administration Menu --}}
    <div class="item sidebar-section">
        <div class="header sidebar-section-header">Administration</div>
        <div class="menu">
            {{ view('layout.menu', [ 'url' => url('users'), 'title' => 'Users', 'routesplit' => $routesplit , 'permission' => Gate::allows('user-view-page')]) }}
            {{ view('layout.menu', [ 'url' => "http://notices.ps-philgeps.gov.ph", 'title' => 'PhilGeps', 'routesplit' => $routesplit, 'permission' => true,'target' => true]) }}
            {{ view('layout.menu', [ 'url' => "division", 'title' => 'Division', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "bac", 'title' => 'BAC', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "inspector", 'title' => 'Inspector', 'routesplit' => $routesplit, 'permission' => true]) }}
            {{ view('layout.menu', [ 'url' => "https://r8.emb.gov.ph/wp-content/uploads/2025/02/EMB8-Citizens-Charter-External-Internal-Service-2025-Edition-portrait-1.pdf", 'title' => 'RA 9184', 'routesplit' => $routesplit, 'permission' => true, 'target' => true]) }}
            {{ view('layout.menu', [ 'url' => url("supplier"), 'title' => 'Supplier', 'routesplit' => $routesplit, 'permission' => Gate::allows('supplier-view-view')]) }}
        </div>
    </div>
    
    {{-- Sidebar bottom decoration --}}
    <div class="sidebar-accent-bottom"></div>
</div>

{{-- Top Navigation --}}
<nav class="ui basic icon top fixed menu custom-topbar">
    <a class="item toggle button">
        <i class="fas fa-bars"></i>
        <span>Menu</span>
    </a>
    <div class="left menu">
        <a href="" class="item page-title">
            @php
                $name = str_replace(".", " ", strtoupper(Request::route()->getName()));
                echo $name;
            @endphp
        </a>
    </div>
    <div class="right menu">
        <a href="#" class="item notification-bell">
            <i class="far fa-bell"></i>
            <span class="notification-dot"></span>
        </a>
        <div class="ui dropdown item user-dropdown">
            <div class="avatar-initials">
                {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
            </div>
            <span class="user-name">{{ Auth::user()->full_name }}</span>
            <i class="fas fa-chevron-down dropdown-arrow"></i>
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
</nav>

{{-- Main Content Area --}}
<div class="pusher">
    <div class="custom-content" id="custom-content">
        <div class="content_header">
            @yield('extra_content')
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