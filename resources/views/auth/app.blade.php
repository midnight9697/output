<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>LOGIN - EMB SYSTEM</title>
    @include('layout.cssinclude')
    
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/site.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/container.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/grid.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/header.cs') }}s">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/image.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/menu.css') }}">

  
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/divider.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/segment.cs') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/form.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/input.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/button.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/list.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/message.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('plugins/login/icon.css') }}">

  
  <script src="{{ url('plugins/login/jquery.min.js.download') }}"></script>
  <script src="{{ url('plugins/login/form.js.download') }}"></script>
  <script src="{{ url('plugins/login/transition.js.download') }}"></script>

    <style>
        body {
            background-color: #DADADA;
        }
        body > .grid {
            height: 100%;
        }
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 450px;
        }
    </style>
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
</head>
<body>
    @yield('content')
</body>
</html>
@include('layout.jsinclude')
@yield('custom_js')