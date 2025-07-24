@extends('auth.app')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
          <img src="{{ url('files/images/emb.png') }}" class="image">
          {{-- <img src="{{ url('files/images/logoko.png') }}" class="image"> --}}
          <div class="content">
            Log-in to your account
          </div>
        </h2>
        <form class="ui large form" method="POST" action="{{ url('login/auth') }}">
            {{ csrf_field() }}
            <div class="ui stacked segment">
              <div class="field">
                <div class="ui left icon input">
                  <i class="user icon"></i>
                  <input type="text" name="email" placeholder="E-mail address">
                </div>
              </div>
              <div class="field">
                <div class="ui left icon input">
                  <i class="lock icon"></i>
                  <input type="password" name="password" placeholder="Password">
                </div>
              </div>
              <div class="ui fluid large teal submit button">Login</div>
            </div>
            <div class="ui error message"></div>
        </form>
        <div class="ui message">
          New to us? <a href="{{ url('register') }}">Sign Up</a>
        </div>
    </div>
  </div>
@endsection