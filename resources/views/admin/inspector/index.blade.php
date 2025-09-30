@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    @include('default.create-button', [
      'name' => 'create_user_vbtn',
      'text' => 'INSPECTOR',
      'icon' => 'plus',
      'link' => url('pr/create')
    ])
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="head1">Header 1</div>
        <div class="item" data-tab="head2">Header 2</div>
    </div>
    <div class="ui bottom attached active tab segment" data-tab="head1">
    </div>
    <div class="ui bottom attached tab segment" data-tab="head2">
    </div>

    
@endsection

@section('custom_js')
    @vite(['resources/js/PR/index.js'])
@endsection