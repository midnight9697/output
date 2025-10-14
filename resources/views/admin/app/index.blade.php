@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    @include('layout.custom-modal', ['view' => 'admin.app.create', 'name' => 'uploadAPPModal', 'title' => 'UPLOAD ANNUAL PROJECT PROCUREMENT PLAN', 'actions_button' => 'submit_upload_button'])
    @include('default.create-button', [
      'name' => 'create_app_vbtn',
      'text' => 'UPLOAD APP',
      'icon' => 'plus',
    ])

    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="head1">ACTIVE</div>
        <div class="item" data-tab="head2">ARCHIVE</div>
    </div>
    <div class="ui bottom attached active tab segment" data-tab="head1">
        @include('default.create-table', [ 'name' => 'app-table',
          'columns' => [
            'REF NO.',
            'TITLE',
            'UPLOADED AT'
          ]
        ])
    </div>
    <div class="ui bottom attached tab segment" data-tab="head2">
    </div>
@endsection

@section('custom_js')
    @vite(['resources/js/app/index.js'])
@endsection