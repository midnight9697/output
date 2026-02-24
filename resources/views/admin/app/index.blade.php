@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
    @include('layout.custom-modal', ['view' => 'admin.app.create', 'name' => 'uploadAPPModal', 'title' => 'UPLOAD ANNUAL PROJECT PROCUREMENT PLAN', 'actions_button' => 'submit_upload_button'])
    {{-- @include('default.create-button', [
      'name' => 'create_app_vbtn',
      'text' => 'UPLOAD APP',
      'icon' => 'plus',
    ]) --}}
    <section class="ui segment">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h2 style="margin:0; font-size:18px;">{{ strtoupper(Request::route()->getName()) }}</h2>
            <button class="btn" style="background: var(--color-success);" id="create_app_vbtn">
              <i class="fa-solid fa-plus"></i> Add New
            </button>
        </div>
        @include('default.create-table', [ 
                'name' => 'app-table',
                'columns' => [
                    'REF NO.',
                    'TITLE',
                    'UPLOADED AT'
                ],
                'creation_id' => 'create_app_vbtn',
            ]
        )
    </section>

@endsection

@section('custom_js')
    @vite(['resources/js/app/index.js'])
@endsection