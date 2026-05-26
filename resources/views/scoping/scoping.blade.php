@extends('scoping.app')

@section('main_content')
@include('scoping.modal')
<section class="ui segment">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h2 style="margin:0; font-size:18px;">{{ strtoupper(Request::route()->getName()) }}</h2>
        <button class="btn" style="background: var(--color-success);" id="insertPSBtn">
          <i class="fa-solid fa-plus"></i> Add New
        </button>
    </div>
    @include('default.create-table', [ 
            'name' => 'iepmc-table',
            'columns' => [
                'TENTATIVE DATE AND TIME',
                'PUBLIC SCOPING LOCATION',
                'PROJECT NAME',
                'PROJECT PROPONENT',
                'PROJECT LOCATION',
            ],
            'creation_id' => 'insertPSBtn-1',
        ]
    )
</section>
@vite(['resources/js/scoping/index.js'])
@endsection