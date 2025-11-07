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
      'text' => 'PURCHASE ORDER',
      'icon' => 'plus',
      'link' => url('purchase_order/create')
    ])
    <div class="ui top attached tabular menu">
        <div class="active item" data-tab="purchase_order_tab">Purchase Order</div>
        {{-- <div class="item" data-tab="head2">Header 2</div> --}}
    </div>
    <div class="ui bottom attached active tab segment" data-tab="purchase_order_tab">
        @include('admin.purchase_order.table', ['name' => 'purchase_order_tab'])
    </div>
    <div class="ui bottom attached tab segment" data-tab="head2">
    </div>

    
@endsection

@section('custom_js')
    @vite(['resources/js/purchase_order/index.js'])
@endsection