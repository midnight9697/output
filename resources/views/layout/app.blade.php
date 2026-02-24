<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PIMS Dashboard</title>
@include('layout.cssinclude')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ url('custom/css/customize-style.css') }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])
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
<body>
    <div class="dashboard">
        <!-- SIDEBAR -->
        <div class="sidebar">
          <div class="logo">
            <img src="{{ url('denr-emb-logo.png') }}" alt="MySystem Logo">
            <span>PIMS</span>
            <small>ENVIRONMENTAL MANAGEMENT BUREAU R08</small>
          </div>
          <div class="sidebar-section">
            <div class="sidebar-title">General</div>
            <ul>
                {{ view('layout.menu', [ 'url' => route('home'), 'title' => 'Dashboard', 'routesplit' => $routesplit, 'permission' => true]) }}
                {{ view('layout.menu', ['badge' => $count_pr_inbox,  'url' => url('pr'), 'title' => 'Purchase Request', 'routesplit' => $routesplit, 'permission' => true]) }}
                {{-- <li class="has-submenu" onclick="toggleUsersMenu(this)">
                    <div class="menu-item">
                      <span><i class="arrow right"></i> Purchase Request</span>
                      <i class="fa-solid fa-chevron-down arrow"></i>
                    </div>
                    <ul class="submenu">
                      <li><i class="fa-solid fa-list"></i> All Users</li>
                      <li><i class="fa-solid fa-user-check"></i> Active Users</li>
                      <li><i class="fa-solid fa-user-xmark"></i> Deactivated Users</li>
                    </ul>
                </li> --}}
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
              <li><i class="fa-solid fa-file-lines"></i> Reports</li>
              <li><i class="fa-solid fa-gear"></i> Settings</li>
            </ul>
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
                      <button class="logout" onclick="logout()">
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
    <script>
        axios.defaults.baseURL = "{{ url('/') }}";
        localStorage.setItem('user', "{{ Auth::user()->id }}")
        
        function toggleDropdown() {
          const dropdown = document.getElementById("profileDropdown");
          dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
        }
    
        function toggleSidebar() {
          document.querySelector(".sidebar").classList.toggle("active");
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