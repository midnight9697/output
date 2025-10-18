
@if ($permission == true)
    <a href="{{ $url }}" target="{{ (isset($target)?"__blank":"") }}" class="item {{ request()->url() == $url ? 'active': '' }}">
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
            @if (isset($badge))
                @if ($badge > 0)
                    <div class="ui red left pointing label">{{ $badge }}</div>
                @else
                    <i class="{{ $icon }} icon"></i>
                @endif
            @else
                <i class="{{ $icon }} icon"></i>
            @endif
            {{ $title }}
        {{-- </div> --}}
    </a>
@endif