<div class="ui right aligned grid" style="padding: 15px 0 30px 0; background: transparent;">
    <div class="left floated">
        @if (isset($link))
          <a href="{{ $link }}" type="button" class="ui tiny primary labeled icon button" id="{{ $name }}" style="background: linear-gradient(135deg, #3b82f6, #1a56db); border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; box-shadow: 0 2px 8px rgba(59,130,246,0.3); transition: all 0.2s;">
            <i class="{{ $icon }} icon"></i> {{ $text }}
          </a>
      @else
          @if (isset($name))
            <button type="button" class="ui tiny primary labeled icon button" id="{{ $name }}" style="background: linear-gradient(135deg, #3b82f6, #1a56db); border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; box-shadow: 0 2px 8px rgba(59,130,246,0.3); transition: all 0.2s;">
                <i class="{{ $icon }} icon"></i> {{ $text }}
            </button>
          @endif
      @endif
    </div>
    @if (isset($view))
        <div class="right floated left aligned six wide column" id="{{ $view }}">
            <div id='progress-section'>
                {{-- Progress Bar --}}
            </div>
        </div>
    @endif
</div>