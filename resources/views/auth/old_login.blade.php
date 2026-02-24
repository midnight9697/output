@extends('auth.app')

@section('content')

<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
          <img src="{{ url('files/images/pims_2.png') }}" class="image" style="width:500px">
          {{-- <img src="{{ url('files/images/logoko.png') }}" class="image"> --}}
        </h2>
        <form class="ui large form" method="POST" action="#" id="loginForm">
            {{ csrf_field() }}
            <div class="ui stacked segment">
              <div class="field">
                <div class="ui left icon input">
                  <i class="user icon"></i>
                  <input type="text" name="email" id="email" placeholder="E-mail address">
                </div>
              </div>
              <div class="field">
                <div class="ui left icon input">
                  <i class="lock icon"></i>
                  <input type="password" name="password" id="password" placeholder="Password">
                </div>
              </div>
              <div class="ui fluid large teal submit button">Login</div>
            </div>
            <div class="ui error message"></div>
        </form>
        <div class="ui message">
          Forgot Password? <a href="{{ url('login/forgot_password') }}">Click here</a>
        </div>
    </div>
  </div>
@endsection
@section('custom_js')
<script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            email: {
              identifier  : 'email',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your e-mail'
                },
                {
                  type   : 'email',
                  prompt : 'Please enter a valid e-mail'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            }
          }
      });
  });
</script>
  @vite(['resources/js/login/index.js'])
@endsection