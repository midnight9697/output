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
      'name' => 'create_abstract_vbtn',
      'text' => 'CREATE ABSTRACT',
      'icon' => 'plus',
    ])
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="head1">ACTIVE</div>
        <div class="item" data-tab="head2">ARCHIVE</div>
    </div>
    <div class="ui bottom attached active tab segment" data-tab="head1">
        @include('default.create-table', [ 'name' => 'abstract-table',
          'columns' => [
            'REF NO.',
            'TITLE',
            'UPLOADED AT'
          ]
        ])
    </div>
    <div class="ui bottom attached tab segment" data-tab="head2">
        show
    </div>

    
@endsection

@section('custom_js')
    @vite(['resources/js/abstract/index.js'])
@endsection