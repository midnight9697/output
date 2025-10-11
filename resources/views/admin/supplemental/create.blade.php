@extends('layout.app')

@section('main_content')
@include('admin.supplemental.modal')
<div class="ui top attached segment">
    <div class="ui two column grid">
        <div class="column">
            <button class="ui grey very tiny button">SUPPLEMENTAL FORM</button>
        </div>
        <div class="column" style="text-align: right">
            <button class="ui primary very tiny button submit_supplemental_form_button">PROCEED</button>
        </div>
    </div>
</div>
<div class="ui form attached segment">
    <form class="ui form formCreateSupplemental" action="#" id="formCreateSupplemental" method="post">
        <div class="ui error message">
            {{--  --}}
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>TITLE</label>
                    <input type="text" name="title" placeholder="TITLE">
                </div>
                <div class="field" style="display: none">
                    <input type="text" name="projects" placeholder="Projects">
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
<div class="ui bottom attached segment">
    @include('default.create-table', [
        'name' => 'projects_table',
        'body' => 'projects_table_body',
        'headers' => [
            (object)['name' => '', 'colspan' => 5],
            (object)['name' => 'Schedule for Each Procurement Activity', 'colspan' => 4],
            (object)['name' => '', 'colspan' => 1],
            (object)['name' => 'Estimated Budget (PhP)', 'colspan' => 3],
        ],
        'columns' => [
            'CODE/PAP',
            "PROCUREMENT PROJECT",
            "END-USER",
            'EARLY PROCUREMENT',
            'MODE OF PROCUEMENT',
            'ADVERTISEMENT',
            'SUBMISSION',
            'NOTICE OF AWARDS',
            'CONTRACT SIGNING',
            'TOTAL',
            'MOOE',
            'CO',
        ]
    ])
</div>
@endsection

@section('custom_js')
    @vite(['resources/js/supplemental/create.js'])
@endsection