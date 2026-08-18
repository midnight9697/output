@extends('auth.app')

@section('content')

<div class="login-container">

  <!-- Logo -->
  <div class="logo">
    <img src="{{ url('denr-emb-logo.png') }}" alt="MySystem Logo">
    <span>PIMS</span>
  </div>

  {{-- <h2>Welcome Back</h2> --}}

  <!-- Login Form -->
  <div class="ui segment" id="loginSegment">
    <div class="ui dimmer" id="login-dimmer">
      <div class="ui text loader" id="loader-text">Authenticating...</div>
    </div>
    <form class="ui large form" method="POST" action="#" id="loginForm">
      {{ csrf_field() }}
      <input type="text" placeholder="Username" name="email" id="email">
      <input type="password" placeholder="Password" name="password" id="password">
      <button type="submit" id="submit-form-btn">Login</button>
      <div class="ui segment" id="loader-segment" hidden>
        <p></p>
        <div class="ui active dimmer">
          <div class="ui loader"></div>
        </div>
      </div>
      <div class="ui error message"></div>
    </form>
  </div>
  <!-- Links -->
  <div class="links">
    <a href="#">Forgot Password?</a>
    <a href="#">Sign Up</a>
  </div>

</div>
@endsection
@section('custom_js')
  @vite(['resources/js/login/index.js'])
@endsection