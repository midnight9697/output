@extends('layout.app')

@section('main_content')
<div class="ui horizontal list">
    @for ($i = 0; $i < 200; $i++)
        <div class="item">
            <img class="ui avatar image" src="{{ url('files/images/square-image.png') }}">
            <div class="content">
              <div class="header">Tom</div>
              Top Contributor
            </div>
        </div>
    @endfor
</div>
</div>
@endsection

@section('custom_js')

@endsection