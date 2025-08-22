@if ($permission == true)
    <a href="{{ $url }}" target="{{ (isset($target)?"__blank":"") }}" class="item {{ in_array("user"||"users", $routesplit)?"notactive":"" }}">
        {{-- <div><i class="icon users"></i>{{ $title }}</div> --}}
        {{-- <i class="home icon"></i> --}}
        @php
            $icon = "";

            switch ($title) {
                case 'Dashboard':
                    $icon = "chart line";
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
                
                default:
                    $icon = "arrow right";
                    break;
            }
        @endphp
        {{-- <div> --}}
            <i class="{{ $icon }} icon"></i>{{ $title }}
        {{-- </div> --}}
    </a>
@endif