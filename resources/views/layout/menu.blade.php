@if ($permission == true)
    <a href="{{ $url }}" target="{{ (isset($target)?"__blank":"") }}" class="item {{ in_array("user"||"users", $routesplit)?"active":"" }}">
        <div><i class="icon users"></i>{{ $title }}</div>
    </a>
@endif