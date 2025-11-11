@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
<div class="ui top attached segment">
    <div class="ui two column grid">
        <div class="column">
            {{-- <button class="ui grey very tiny button">REQUEST FOR QUOTATION FORM</button> --}}
        </div>
        <div class="column" style="text-align: right">
            <button class="ui primary very tiny button submit_supplier_form_button">PROCEED</button>
        </div>
    </div>
</div>
<div class="ui form attached segment">
    <form class="ui form formCreatePurchaseOrder" action="#" id="formCreatePurchaseOrder" method="post">
        <div class="ui error message">
            {{--  --}}
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>SUPPLIER NAME</label>
                    <input type="text" name="supplier_name" placeholder="SUPPLIER NAME">
                </div>
                <div class="field">
                    <label>SUPPLIER ADDRESS</label>
                    <input type="text" name="supplier_address" placeholder="SUPPLIER ADDRESS">
                </div>
            </div>
        </div>
   
    </form>
</div>  
    
@endsection

@section('custom_js')
    @vite(['resources/js/purchase_order/update.js'])

@endsection