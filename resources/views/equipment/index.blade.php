@extends('layout.app')

@section('custom_css')
    <style>
        .prTable {
            width:100%;
        }
    </style>
@endsection

@section('main_content')
@include('iepmc.create')
@include('iepmc.update')
<section class="ui segment">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h2 style="margin:0; font-size:18px;">{{ strtoupper(Request::route()->getName()) }}</h2>
        <button class="btn" style="background: var(--color-success);" id="create_iepmc_btn">
          <i class="fa-solid fa-plus"></i> Add New
        </button>
    </div>
    @include('default.create-table', [ 
            'name' => 'equipment-table',
            'columns' => [
                'PROPERTY NUMBER',
                'EQUIPMENT TYPE',
                'DESCRIPTION',
                'STATUS',
                'ISSUEDTO / LOCATION',
                'DIVISION',
                'REMARKS',
            ],
            'creation_id' => 'create_equipment_btn',
        ]
    )
</section>
@endsection

@section('custom_js')
    @vite(['resources/js/equipment/index.js'])
@endsection