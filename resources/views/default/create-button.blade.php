<div class="ui right aligned grid" style="padding:15px">
    <div class="left floated">
        @if (isset($link))
          <a href="{{ $link }}" type="button" class="ui tiny primary labeled icon button" id="{{ $name }}">
            <i class="{{ $icon }} icon"></i> {{ $text }}
          </a>
      @else
          @if (isset($name))
            <button type="button" class="ui tiny primary labeled icon button" id="{{ $name }}">
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
