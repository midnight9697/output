@extends('layout.app')

@section('main_content')
@include('admin.supplemental.modal')
<div class="ui top attached segment">
    <div class="ui two column grid">
        <div class="column">
            <button class="ui grey very tiny button">SUPPLEMENTAL FORM</button>
        </div>
        <div class="column" style="text-align: right">
            <button class="ui primary very tiny button submit_rfq_form_button">PROCEED</button>
        </div>
    </div>
</div>
<div class="ui form attached segment">
    <form class="ui form formCreateRFQ" action="#" id="formCreateRFQ" method="post">
        <div class="ui error message">
            {{--  --}}
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>TITLE</label>
                    <input type="text" name="title" placeholder="TITLE">
                </div>
            </div>
        </div>
    </form>
</div>
<div class="ui top attached segment">
    <div class="ui two column grid">
        <div class="column">
            <b class="modal-title">PRCUREMENT PROJECTS</b>
        </div>
        <div class="column" style="text-align:right">
            <button class="ui primary very tiny button add_item_button">ADD ITEM</button>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
    @vite(['resources/js/supplemental/create.js'])
@endsection