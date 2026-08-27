@if ($permission == true)
    <a href="{{ $url }}" target="{{ (isset($target)?"__blank":"") }}" class="item {{ request()->url() == $url ? 'active': '' }}">
        @php
            $icon = "";

            switch ($title) {
                case 'Dashboard':
                    $icon = "chart line";
                    break;
                case 'Purchase Request':
                    $icon = "shopping cart";
                    break;
                case 'APP':
                    $icon = "file outline";
                    break;
                case 'PPMP':
                    $icon = "clipboard list";
                    break;
                case 'Supplemental':
                    $icon = "plus circle";
                    break;
                case 'RFQ':
                    $icon = "file alternate";  
                    break;
                case 'Purchase Order':
                    $icon = "file alternate";
                    break;
                case 'Abstract':
                    $icon = "table";
                    break;
                case 'Users':
                    $icon = "users";
                    break;
                case 'PhilGeps':
                    $icon = "calendar check";
                    break;
                case 'Division':
                    $icon = "building";
                    break;
                case 'BAC':
                    $icon = "users";
                    break;
                case 'Inspector':
                    $icon = "user secret";
                    break;
                case 'RA 9184':
                    $icon = "file alternate outline";
                    break;
                case 'Supplier':
                    $icon = "truck";
                    break;
                default:
                    $icon = "arrow right";
                    break;
            }
        @endphp
        <span class="menu-title">
    <span>{{ $title }}</span>
</span>

<span class="menu-icon">
    @if (isset($badge) && $badge > 0)
        <span class="notification-badge">{{ $badge }}</span>
    @endif

    <i class="icon {{ $icon }}"></i>
</span>
    </a>
@endif