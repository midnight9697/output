@extends('mail.app')

@section('content')
    <div class="ui grid">
        <div class="row">
          <div class="column">
            <h1 class="ui header">Welcome to our Newsletter!</h1>
            <p>This is an email created by Marco C. Pantonial.</p>
            <p>Please click the link below to reset password</p>
            <a class="ui primary button" href="{{ $url['url'] }}">Click here</a>
          </div>
        </div>
    </div>
@endsection