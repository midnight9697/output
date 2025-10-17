@extends('layout.app')

@section('main_content')
@include('admin.rfq.create')
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
    <form class="ui form formCreateSupplier" action="#" id="formCreateSupplier" method="post">
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
                    <label>PROVINCE</label>
                    <div class="ui selection dropdown" id="supplier_province">
                        <input type="hidden" name="supplier_province">
                        <i class="dropdown icon"></i>
                        <div class="default text">PROVINCE</div>
                        <div class="menu">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>MUNICIPALITY</label>
                    <div class="ui selection dropdown" id="supplier_municipality">
                        <input type="hidden" name="supplier_municipality">
                        <i class="dropdown icon"></i>
                        <div class="default text">MUNICIPALITY</div>
                        <div class="menu">
                          
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>BARANGAY</label>
                    <div class="ui selection dropdown" id="supplier_barangay">
                        <input type="hidden" name="supplier_barangay">
                        <i class="dropdown icon"></i>
                        <div class="default text">BARANGAY</div>
                        <div class="menu">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="field">
            <div class="three fields">
                <div class="field">
                    <label>APPROVED BUDGET</label>
                    <input type="text" name="approved_budget" placeholder="APPROVED BUDGET">
                </div>
                <div class="field">
                    <label>STANDARD UNIT</label>
                    <input type="text" name="standard_unit" placeholder="STANDARD UNIT">
                </div>
                <div class="field">
                    <label>TARGET DELIVERY DATE</label>
                    <input type="text" name="target_deliver_date" placeholder="TARGET DELIVERY DATE">
                </div>
            </div>
        </div>
        <div class="field">
            <div class="two fields">
                <div class="field">
                    <label>PROJECT PURPOSE</label>
                    <textarea name="project_purpose" placeholder="PROJECT PURPOSE"></textarea>
                </div>
                <div class="field">
                    <label>ATTACHMENT 1</label>
                    <textarea name="attachment_one" placeholder="ATTACHMENT 1"></textarea>
                </div>
            </div>
        </div>
        <div class="field" style="display:none">
            <label>SPECIFICATIONS</label>
            <input type="text" name="specification">
        </div> --}}
        
    </form>
</div>
{{-- <div class="ui top attached segment">
    <div class="ui two column grid">
        <div class="column">
            <b class="modal-title">REQUEST FOR QUOTATION ITEMS LIST</b>
        </div>
        <div class="column" style="text-align:right">
            <button class="ui primary very tiny button add_item_button">ADD ITEM</button>
        </div>
    </div>
</div>
<div class="ui attached segment">
    @include('default.create-table', [
        'name' => 'quotation_items_table',
        'body' => 'quotation_table_body',
        'columns' => [
            'SEPCIFICATIONS',
            "BIDDER'S SPECIFICATIONS",
            "UNIT",
            'QUANTITY',
            'UNIT PRICE',
            'TOTAL PRICE',
            'ACTION',
        ]
    ])
</div> --}}
@endsection
@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    @vite(['resources/js/supplier/create.js'])
@endsection