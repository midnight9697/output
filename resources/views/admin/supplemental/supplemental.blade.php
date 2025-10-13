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
@include('default.create-button', [
  'name' => 'create-supplemental',
  'text' => 'SUPPLEMENTAL',
  'icon' => 'upload',
  'view' => "progress-upload",
  'link' => url('supplemental/create')
])

@include('default.create-table', [ 'name' => 'splTable',
  'columns' => [
    'CODE',
    'TITLE',
    'UPLOADED AT'
  ]
])

@endsection

@section('custom_js')
    @vite(['resources/js/supplemental/index.js'])
@endsection