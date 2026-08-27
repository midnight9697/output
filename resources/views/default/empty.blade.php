@if (!isset($description))
    @php
        $description = "No Available data";
    @endphp
@endif

<div class="ui placeholder segment" style="margin-top: 0px; border-radius: 16px; border: 2px dashed #e2e8f0; background: #fafbfc; padding: 60px 40px;">
    <div class="ui icon header" style="color: #94a3b8; font-weight: 400;">
        <i class="inbox icon" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 16px;"></i>
        <div style="font-size: 1.1rem; color: #64748b; font-weight: 500;">{{ $description }}</div>
    </div>
    @if (isset($uri)) {
        <a href="{{ url('supplemental/upload') }}" class="ui tiny primary icon button" style="background: linear-gradient(135deg, #3b82f6, #1a56db); border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; box-shadow: 0 2px 8px rgba(59,130,246,0.3);">
            {{ $name }}
        </a>
    }
    @endif

    @if (isset($id))
        <button id="{{ $id }}" class="ui tiny primary icon button" id="create_user_vbtn" style="background: linear-gradient(135deg, #3b82f6, #1a56db); border: none; padding: 10px 24px; border-radius: 8px; font-weight: 600; box-shadow: 0 2px 8px rgba(59,130,246,0.3);">
            {{ isset($name)?$name:'ADD NEW' }}
        </button>
    @endif
</div>