<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - MySystem</title>
<meta name="csrf-token" content="{{csrf_token()}}" />
<script src="{{ url('plugins/login/jquery.min.js.download') }}"></script>
<script src="{{ url('plugins/login/form.js.download') }}"></script>
<script src="{{ url('plugins/login/transition.js.download') }}"></script>
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ url('custom/css/custom-login-style.css') }}">

</head>
@include('layout.cssinclude')
<body>

<div class="login-container">

  <!-- Logo -->
  <div class="logo">
    <img src="{{ url('denr-emb-logo.png') }}" alt="MySystem Logo">
    <span>PIMS</span>
  </div>

  {{-- <h2>Welcome Back</h2> --}}

  <!-- Login Form -->
  <form class="ui large form" method="POST" action="#" id="loginForm">
    {{ csrf_field() }}
    <input type="text" placeholder="Username" required name="email" id="email">
    <input type="password" placeholder="Password" required name="password" id="password">
    <button type="submit">Login</button>
    <div class="ui error message"></div>
  </form>

  <!-- Links -->
  <div class="links">
    <a href="#">Forgot Password?</a>
    <a href="#">Sign Up</a>
  </div>

</div>
@include('layout.jsinclude')

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
</body>
</html>