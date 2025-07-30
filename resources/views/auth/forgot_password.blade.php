@extends('auth.app')

@section('content')
<div class="ui middle aligned center aligned grid">
    <div class="column">
        <h2 class="ui teal image header">
          <img src="{{ url('files/images/emb.png') }}" class="image">
          {{-- <img src="{{ url('files/images/logoko.png') }}" class="image"> --}}
          <div class="content">
            Reset your password
          </div>
        </h2>
        <form class="ui large form" method="POST" action="#" id="loginForm">
            {{ csrf_field() }}
            <div class="ui stacked segment">
              <div class="field">
                <div class="ui left icon input">
                  <i class="user icon"></i>
                  <input type="text" name="email" id="email" placeholder="Enter Registered Email">
                </div>
              </div>
              <div class="ui fluid large teal submit button">SUBMIT</div>
            </div>
            <div class="ui error message"></div>
        </form>
        <div class="ui message">
          Back to Login <a href="{{ url('login') }}">Click here</a>
        </div>
    </div>
  </div>
@endsection
@section('custom_js')
  {{-- @vite(['resources/js/login/index.js']) --}}
@endsection