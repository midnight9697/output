@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    <div class="ui right aligned grid">
        <div class="left floated left aligned six wide column">
            <a href="{{ url('pr/create') }}" class="ui tiny primary labeled icon button" id="create_user_vbtn">
              <i class="plus icon"></i> NEW
            </a>
        </div>
    </div>
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="inbox">INBOX</div>
        <div class="item" data-tab="outbox">OUTBOX</div>
        <div class="item" data-tab="personal">TRACK</div>
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
    
@endsection

@section('custom_js')
    @vite(['resources/js/PR/index.js'])
@endsection