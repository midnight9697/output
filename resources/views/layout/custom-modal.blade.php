<div class="ui top aligned {{ isset($size)?$size:"" }} modal" id="{{ $name }}" style="border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
    <i class="close icon" style="color: #94a3b8; transition: color 0.2s; top: 16px; right: 16px;"></i>
    <div class="header" style="background: #f8fafc; padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
        <h3 class="modal-title" style="font-weight: 600; color: #0f172a; margin: 0; font-size: 1.1rem;">{{ $title }}</h3>
    </div>
    <div class="content" style="padding: 24px; background: #ffffff;">
        @include($view)
    </div>
    @if ($actions_button)
        <div class="actions" style="background: #f8fafc; padding: 16px 24px; border-top: 1px solid #e2e8f0; border-radius: 0 0 16px 16px;">
            <button class="ui primary very tiny button {{ $actions_button }}" style="background: linear-gradient(135deg, #3b82f6, #1a56db); border: none; padding: 10px 24px; font-weight: 600; border-radius: 8px; transition: all 0.2s; box-shadow: 0 2px 8px rgba(59,130,246,0.3);">
                PROCEED
            </button>
        </div>
    @endif
</div>