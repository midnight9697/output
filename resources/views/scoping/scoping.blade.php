@extends('scoping.app')

@section('content')
<section class="ui segment">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h2 style="margin:0; font-size:18px;">{{ strtoupper(Request::route()->getName()) }}</h2>
        <button class="btn" style="background: var(--color-success);" id="create_iepmc_btn">
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
            'creation_id' => 'create_iepmc_btn',
        ]
    )
</section>
@vite(['resources/js/scoping/index.js'])
@endsection