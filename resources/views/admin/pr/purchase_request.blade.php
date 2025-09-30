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
      'text' => 'PURCHASE REQUEST',
      'icon' => 'plus',
      'link' => url('pr/create')
    ])
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="inbox">INBOX</div>
        <div class="item" data-tab="outbox">OUTBOX</div>
        <div class="item" data-tab="personal">TRACK</div>
        <div class="item" data-tab="close">CLOSED</div>
    </div>
    <div class="ui bottom attached active tab segment" data-tab="inbox">
        @include('admin.pr.pr_table', ['name' => 'inbox'])
    </div>
    <div class="ui bottom attached tab segment" data-tab="outbox">
        @include('admin.pr.pr_table', ['name' => 'outbox'])
    </div>
    <div class="ui bottom attached tab segment" data-tab="personal">
        @include('admin.pr.pr_table', ['name' => 'personal'])
    </div>
    <div class="ui bottom attached tab segment" data-tab="close">
        @include('admin.pr.pr_table', ['name' => 'close'])
    </div>
    
@endsection

@section('custom_js')
    @vite(['resources/js/PR/index.js'])
@endsection