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
            <button class="ui primary very tiny button submit_purchase_order_form_button">PROCEED</button>
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
                    <select name="supplier_name" id="supplier_name" placeholder="SUPPLIER NAME">
                    </select>
                </div>
                <div class="field">
                    <label>PROVINCE</label>
                    <input type="text" name="supplier_province" placeholder="SUPPLIER PROVINCE" disabled>
                </div>
            </div>
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>MUNICIPALITY</label>
                    <input type="text" name="supplier_municipality" placeholder="SUPPLIER MUNICIPALITY" disabled>

                    </select>
                </div>
                <div class="field">
                    <label>BARANGAY</label>
                    <input type="text" name="supplier_barangay" placeholder="SUPPLIER BARANGAY" disabled>
                </div>
            </div>
        </div>
    </form>
</div>  
    
@endsection

@section('custom_js')
    @vite(['resources/js/purchase_order/create.js'])
@endsection