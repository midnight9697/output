@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    @include('layout.custom-modal', ['view' => 'admin.ppmp.create', 'name' => 'uploadPPMPModal', 'title' => 'UPLOAD PROJECT PROCUREMENT MANAGEMENT PLAN', 'actions_button' => 'submit_upload_button'])
    <section class="ui segment">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h2 style="margin:0; font-size:18px;">PROJECT PROCUREMENT MONITORING PLAN</h2>
            <button class="btn" style="background: var(--color-success);" id="create_ppmp_vbtn">
              <i class="fa-solid fa-plus"></i> Add New
            </button>
        </div>
        @include('default.create-table', [ 'name' => 'ppmp-table',
          'columns' => [
            'REF NO.',
            'TITLE',
            'UPLOADED AT'
          ]
        ])
    </section>
@endsection

@section('custom_js')
    @vite(['resources/js/ppmp/index.js'])
@endsection