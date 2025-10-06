@extends('layout.app')

@section('main_content')
<div class="ui top attached segment">
    <h5>REQUEST FOR QUOTATION FORM</h5>
</div>
<div class="ui form attached segment">
    <form class="ui form" action="#" id="formCreateRFQ" method="post">
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>PROCUREMENT CLASSIFICATION</label>
                    <div class="ui selection dropdown">
                        <input type="hidden" name="classification">
                        <i class="dropdown icon"></i>
                        <div class="default text">Procurement Classification</div>
                        <div class="menu">
                          <div class="item" data-value="1">Male</div>
                          <div class="item" data-value="0">Female</div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>RFQ NO.</label>
                    <input type="text" name="project_purpose" placeholder="RFQ NO.">
                </div>
            </div>
        </div>
        <div class="field">
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
        
    </form>
</div>
<div class="ui top attached segment">
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
        'columns' => [
            'SEPCIFICATIONS',
            "BIDDER'S SPECIFICATIONS",
            'QUANTITY',
            'UNIT PRICE',
            'TOTAL PRICE'
        ]
    ])
</div>
@endsection
@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    @vite(['resources/js/rfq/create.js'])
@endsection