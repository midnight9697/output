@extends('auth.app')

@section('content')
{{-- <script> --}}
     @vite(['resources/js/login/reset_password.js'])
{{-- </script> --}}
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
          <img src="{{ url('files/images/emb.png') }}" class="image">
          {{-- <img src="{{ url('files/images/logoko.png') }}" class="image"> --}}
          <div class="content">
            Reset your password
          </div>
        </h2>
        <form class="ui large form" method="POST" action="#" id="resetPasswordForm">
            {{ csrf_field() }}
            <div class="ui stacked segment">
              <div class="field">
                <div class="ui left icon input">
                  <i class="lock icon"></i>
                  <input type="password" name="password" id="password" placeholder="Password">
                </div>
              </div>
              <div class="field">
                <div class="ui left icon input">
                  <i class="user icon"></i>
                  <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
                </div>
              </div>
              <div class="ui fluid large teal submit button">UPDATE PASSWORD</div>
            </div>
            <div class="ui error message"></div>
        </form>
        <div class="ui message">
          Remember? <a href="{{ url('login') }}">Click here</a>
        </div>
    </div>
  </div>
@endsection
@section('custom_js')
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        localStorage.setItem('email', "{{ $email }}");
    })
  </script>

@endsection