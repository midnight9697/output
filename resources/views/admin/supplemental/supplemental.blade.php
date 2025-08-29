@extends('layout.app')

@section('custom_css')
    @vite(['resources/css/supplemental.css'])
@endsection

@section('main_content')
@include('admin.supplemental.upload')
{{-- <div class="ui right aligned grid">
    <div class="left floated left aligned six wide column">
        <a href="{{ url('supplemental/upload') }}" class="ui tiny primary labeled icon button" id="create_user_vbtn">
          <i class="plus icon"></i> UPLOAD SUPPLEMENTAL
        </a>
    </div>
</div> --}}
@if ($sup->count() > 0)
<div class="ui stackable grid" style="margin-top:0px;margin-bottom:0px;padding:0px">
    <div class="three wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui people shape">
            <div class="sides">
              <div class="active side">
                <div class="ui card">
                  <div class="small image">
                    <img src="{{ url('files/images/file-image.png') }}">
                  </div>
                  <div class="content">
                    <div class="header">Steve Jobes</div>
                    <div class="meta">
                      <a>Acquaintances</a>
                    </div>
                    <div class="description">
                      Steve Jobes is a fictional character designed to resemble someone familiar to readers.
                    </div>
                  </div>
                  <div class="extra content">
                    <span class="right floated">
                      Joined in 2014
                    </span>
                    <span>
                      <i class="user icon"></i>
                      151 Friends
                    </span>
                  </div>
                </div>
              </div>
              <div class="side">
                <div class="ui card">
                  <div class="image">
                    <img src="{{ url('files/images/file-image.png') }}">
                  </div>
                  <div class="content">
                    <a class="header">Stevie Feliciano</a>
                    <div class="meta">
                      <span class="date">Joined in 2014</span>
                    </div>
                    <div class="description">
                      Stevie Feliciano is a library scientist living in New York City. She likes to spend her time reading, running, and writing.
                    </div>
                  </div>
                  <div class="extra content">
                    <a>
                      <i class="user icon"></i>
                      22 Friends
                    </a>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endif
  @if ($sup->count() == 0)
    @include('default.empty', [
        'id' => 'create-supplemental',
        'name' => 'UPLOAD SUPPLEMENTAL'
    ])
  @endif
@endsection

@section('custom_js')
    @vite(['resources/js/supplemental/index.js'])
@endsection