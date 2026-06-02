@extends('scoping.app')

@section('main_content')
@include('scoping.modal')
<section class="ui segment">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h2 style="margin:0; font-size:18px;">{{ strtoupper(Request::route()->getName()) }}</h2>
        <button class="btn" style="background: var(--color-success);" id="insertPHBtn">
          <i class="fa-solid fa-plus"></i> Add New
        </button>
    </div>
    @include('default.create-table', [ 
      'name' => 'hearing-table',
      'columns' => [
          'TENTATIVE DATE AND TIME',
          'PUBLIC HEARING LOCATION',
          'PROJECT NAME',
          'PROJECT PROPONENT',
          'PROJECT LOCATION',
      ],
      'creation_id' => 'insertPHBtn-1',
  ]
)
</section>
@endsection

@section('custom_js')
  @vite(['resources/js/scoping/hearing.js'])
@endsection