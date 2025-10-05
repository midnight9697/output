@extends('layout.app')

@section('main_content')
    @include('admin.rfq.create')
    @include('default.create-button', [
      'name' => 'create_rfq_btn',
      'text' => 'CREATE RFQ',
      'icon' => 'plus',
    ])
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="rfq-inbox">RFQ</div>
        <div class="item" data-tab="rfq-outbox">ARCHIVED</div>
    </div>
    
    <div class="ui bottom attached active tab segment" data-tab="rfq-inbox">
        @include('admin.rfq.table', ['name' => 'rfq-inbox'])
    </div>
    <div class="ui bottom attached tab segment" data-tab="rfq-outbox">
        @include('admin.rfq.table', ['name' => 'rfq-outbox'])
    </div>
    
@endsection
@section('custom_js')
    @vite(['resources/js/rfq/index.js'])
@endsection