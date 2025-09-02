@if (!isset($description))
    @php
        $description = "No Available data";
        // No users have been added yet.
    @endphp
@endif

<div class="ui placeholder segment" style="margin-top:0px">
    <div class="ui icon header">
      <i class="inbox icon"></i>
      {{ $description }}
    </div>
    @if (isset($uri)) {
        <a href="{{ url('supplemental/upload') }}" class="ui tiny primary icon button">
            {{ $name }}
        </a>
    }
    @endif

    @if (isset($id))
        <button id="{{ $id }}" class="ui tiny primary icon button" id="create_user_vbtn">
            {{ isset($name)?$name:'ADD NEW' }}
        </button>
    @endif
</div>