<div class="ui sidebar vertical inverted  menu visible main-sidebar" id="main-sidebar">
  <div class="item">
    <div class="sixteen wide column">
      <img src="{{ url('files/images/emb.png') }}" class="ui very tiny circular image centered">
    </div>
    <div class="content" style="text-align: center">
      {{-- <a class="header">{{ Auth::user()->full_name }}</a> --}}
      <div class="meta">
        <span class="date">{{ Auth::user()->full_name }}</span>
      </div>
      <div class="description">
        {{ Auth::user()->profile->position }}
      </div>
    </div>
  </div>
  <div class="item">
    <div class="header">General</div>
      <div class="menu">
        <a href="{{ route('home') }}" class="item {{ Request::route()->getName() == 'home'?'active':'' }}">
          <i class="home icon"></i>
          Home
        </a>
        <a href="{{ route('purchase request') }}" class="item {{ Request::route()->getName() == 'funds'?'active':'' }}" class="item">
          <i class="block layout icon"></i>
          Funds/Bills
        </a>
        <a href="{{ url('bills') }}" class="item {{ Request::route()->getName() == 'credits'?'active':'' }}" class="item">
          <i class="smile icon"></i>
          Credits
        </a>
      </div>
  </div>
  
</div>
<div class="ui basic icon top fixed menu">
  <a class="item toggle button">
    <i class="sidebar icon"></i>
    Menu
  </a>
</div>