<div class="ui top aligned {{ isset($size)?$size:"" }} modal" id="{{ $name }}" >
    <i class="close icon"></i>
    <div class="header">
        <h3 class="modal-title">{{ $title }}</h3>
    </div>
    <div class="content">
        @include($view)
    </div>
    @if ($actions_button)
        <div class="actions">
            <button class="ui primary very tiny button {{ $actions_button }}">PROCEED</button>
        </div>
    @endif
    
</div>