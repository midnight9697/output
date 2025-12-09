@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    @include('layout.custom-modal', ['view' => 'admin.ppmp.create', 'name' => 'uploadPPMPModal', 'title' => 'UPLOAD PROJECT PROCUREMENT MANAGEMENT PLAN', 'actions_button' => 'submit_upload_button'])
    @include('default.create-button', [
      'name' => 'create_ppmp_vbtn',
      'text' => 'UPLOAD PPMP',
      'icon' => 'plus',
    ])

    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="head1">PROJECT PROCUREMENT MONITORING PLAN</div>
    </div>
    <div class="ui bottom attached active tab segment" data-tab="head1">
        @include('default.create-table', [ 'name' => 'ppmp-table',
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
    @vite(['resources/js/ppmp/index.js'])
@endsection