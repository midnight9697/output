@extends('layout.app')

@section('custom_css')
    @vite(['resources/css/supplemental.css'])
@endsection

@section('main_content')
@include('admin.supplemental.upload')

<style>
  .splTable {
      width:100%;
  }
</style>
{{-- @include('default.create-button', [
  'name' => 'create-supplemental',
  'text' => 'SUPPLEMENTAL',
  'icon' => 'upload',
  'view' => "progress-upload",
  'link' => url('supplemental/create')
]) --}}

<section class="ui segment">
  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
      <h2 style="margin:0; font-size:18px;">SUPPLEMENTAL</h2>
      <a href="{{ url('supplemental/create') }}" class="btn" style="background: var(--color-success);" id="create-supplemental">
        <i class="fa-solid fa-plus"></i> Add New
      </a>
  </div>
  @include('default.create-table', [ 'name' => 'splTable',
    'columns' => [
      'CODE',
      'TITLE',
      'UPLOADED AT'
    ]
  ])
</section>
@endsection

@section('custom_js')
    @vite(['resources/js/supplemental/index.js'])
@endsection