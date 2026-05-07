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
@yield('custom_css')
<body id="main_event">
    <div class="dashboard">
        <!-- SIDEBAR -->
        <div class="sidebar">

          <!-- HEADER (Fixed) -->
          <div class="sidebar-header">
              <div class="logo">
                <img src="{{ url('denr-emb-logo.png') }}" alt="MySystem Logo">
                <span>PIMS</span>
                <small>ENVIRONMENTAL MANAGEMENT BUREAU R08</small>
              </div>
          </div>
      
          <!-- SCROLLABLE MENU -->
          <div class="sidebar-menu">
            <div class="sidebar-section">
              <div class="sidebar-title">General</div>
              <ul>
                  {{ view('layout.menu', [ 'url' => route('home'), 'title' => 'Dashboard', 'routesplit' => $routesplit, 'permission' => true]) }}
                  {{-- {{ view('layout.menu', ['badge' => $count_pr_inbox,  'url' => url('pr'), 'title' => 'Purchase Request', 'routesplit' => $routesplit, 'permission' => true]) }} --}}
                  <li>
                      <div class="has-submenu" onclick="toggleUsersMenu(this)">
                        <div class="menu-item">
                          <span><i class="users icon"></i> Purchase Request</span>
                          <i class="fa-solid fa-chevron-down arrow" style="position:absolute;left:200px"></i>
                        </div>
                        <ul class="submenu">
                          {{-- <li><a href="{{ url('pr/inbox') }}"><i class="arrow left icon"></i> Inbox</a></li> --}}
                          {{-- <li><a href="{{ url('pr/outbox') }}"><i class="arrow left icon"></i> Outbox</a></li> --}}
                          <li><a href="{{ url('pr/draft') }}"><i class="arrow left icon"></i> Draft PR</a></li>
                          <li><a href="{{ url('pr/approved') }}"><i class="arrow left icon"></i> Archived</a></li>
                          {{-- <li><a href="{{ url('pr/approved') }}"><i class="arrow left icon"></i> Approved</a></li> --}}
                        </ul>
                      </div>
                  </li>
                  {{ view('layout.menu', [ 'url' => url('app'), 'title' => 'APP', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
                  {{ view('layout.menu', [ 'url' => url('ppmp'), 'title' => 'PPMP', 'routesplit' => $routesplit, 'permission' => true]) }}
                  {{ view('layout.menu', [ 'url' => url('supplemental'), 'title' => 'Supplemental', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
                  {{ view('layout.menu', [ 'url' => url('rfq'), 'title' => 'RFQ', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
                  {{ view('layout.menu', [ 'url' => url('purchase_order'), 'title' => 'Purchase Order', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
                  {{ view('layout.menu', [ 'url' => url('abstract'), 'title' => 'Abstract', 'routesplit' => $routesplit, 'permission' => Auth::user()->role != 'user']) }}
              </ul>
            </div>
            <hr>
            <!-- Administration Section -->
            <div class="sidebar-section">
              <div class="sidebar-title">Administration</div>
              <ul>
                {{ view('layout.menu', [ 'url' => url('users'), 'title' => 'Users', 'routesplit' => $routesplit , 'permission' => Gate::allows('user-view-page')]) }}
                {{ view('layout.menu', [ 'url' => "http://notices.ps-philgeps.gov.ph", 'title' => 'PhilGeps', 'routesplit' => $routesplit, 'permission' => true,'target' => true]) }}
                {{ view('layout.menu', [ 'url' => "division", 'title' => 'Division', 'routesplit' => $routesplit, 'permission' => true]) }}
                {{ view('layout.menu', [ 'url' => "bac", 'title' => 'BAC', 'routesplit' => $routesplit, 'permission' => true]) }}
                {{ view('layout.menu', [ 'url' => "inspector", 'title' => 'Inspector', 'routesplit' => $routesplit, 'permission' => true]) }}
                {{ view('layout.menu', [ 'url' => "https://r8.emb.gov.ph/wp-content/uploads/2025/02/EMB8-Citizens-Charter-External-Internal-Service-2025-Edition-portrait-1.pdf", 'title' => 'RA 9184', 'routesplit' => $routesplit, 'permission' => true, 'target' => true]) }}
                {{ view('layout.menu', [ 'url' => url("supplier"), 'title' => 'Supplier', 'routesplit' => $routesplit, 'permission' => Gate::allows('supplier-view-view')]) }}
              </ul>
            </div>
          </div>
      
          <!-- FOOTER (Fixed) -->
          <div class="sidebar-footer">
            <div class="footer-user">
              <i class="fa-solid fa-user-circle"></i>
              <div>
                <div class="user-name">
                  {{ Auth::user()->full_name }}
                </div>
                <div class="user-role"><small>{{ Auth::user()->profile->position }}</small></div>
              </div>
            </div>
        
            <button class="btn btn-logout">
              <i class="fa-solid fa-right-from-bracket"></i>
              Logout
            </button>
        
            <div class="footer-version">
              v1.0.0
            </div>
          </div>
      
      </div>
        
        <!-- MAIN -->
      <div class="main">
            <!-- NAVBAR -->
            <div class="navbar">
                <div>
                  <i class="fa-solid fa-bars" onclick="toggleSidebar()"></i>
                  <h1 style="display: inline;">Dashboard</h1>
                </div>
                <div class="profile-container">
                    <div class="profile-btn" onclick="toggleDropdown()">
                      <i class="fa-solid fa-user"></i>
                      Admin
                      <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="dropdown" id="profileDropdown">
                      <button onclick="viewProfile()">
                        <i class="fa-solid fa-id-badge"></i> Profile
                      </button>
                  
                      <button onclick="changePassword()">
                        <i class="fa-solid fa-key"></i> Change Password
                      </button>
                      <button class="logout" id="logout_user">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                      </button>
                    </div>
                </div>
            </div>
            <!-- CONTENT -->
        <div class="content">
            @yield('main_content')
            <div class="overlay" id="overlay" onclick="closeSidebar()"></div>
        </div>
    </div>
    @include('layout.jsinclude')
    <link rel="stylesheet" href="{{ url('custom/css/custom-crud-style.css') }}">
    <style>
      .ui.dropdown {
          position: sticky;
          display: block;
          /* z-index: 1000; */
      }
    </style>
    <script>
        
        axios.defaults.baseURL = "{{ url('/') }}";
        localStorage.setItem('user', "{{ Auth::user()->id }}")
        
        function toggleDropdown() {
          const dropdown = document.getElementById("profileDropdown");
          dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
        }
    
        function toggleSidebar() {
          document.querySelector(".sidebar").classList.toggle("active");
          console.log(document.querySelector(".sidebar"));
          document.getElementById("overlay").classList.toggle("active");
        }
        
        function closeSidebar() {
          document.querySelector(".sidebar").classList.remove("active");
          document.getElementById("overlay").classList.remove("active");
        }

        function toggleUsersMenu(element) {
          element.classList.toggle("active");
        }
    </script>
    @yield('custom_js')
</body>
</html>