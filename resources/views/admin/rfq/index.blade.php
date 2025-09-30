@extends('layout.app')

@section('main_content')
    @include('admin.rfq.create')
    @include('default.create-button', [
      'name' => 'create_rfq_btn',
      'text' => 'CREATE RFQ',
      'icon' => 'plus',
    ])
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="inbox">RFQ</div>
        <div class="item" data-tab="outbox">ARCHIVED</div>
    </div>
    
    <div class="ui bottom attached active tab segment">
       
        {{-- @include('default.create-table', [ 'name' => 'rfq-table',
            'columns' => [
              'PR No.',
              'Entity Name',
              'Fund Cluster',
              'Office',
              'Responsibility Code',
              'Purpose',
              'Creator',
              'Member',
              'Date Created',
              'Latest Update',

            ]
        ]) --}}
    </div>
@endsection
@section('custom_js')
    <script>
        
    </script>
    @vite(['resources/js/rfq/index.js'])
@endsection