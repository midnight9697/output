@extends('layout.app')

@section('main_content')
@include('layout.custom-modal', [
    'view' => 'admin.pr.monitor', 
    'name' => 'updateMonitorModal', 
    'title' => 'PR MONITORING', 
    'actions_button' => 'submit_monitoring_button',
    'size' => 'small'
])
<section class="ui segment">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h2 style="margin:0; font-size:18px;">{{ strtoupper($name) }}</h2>
        <a href="{{ url('pr/create') }}" class="btn create_user_vbtn" id="create_user_vbtn" style="background: var(--color-success);" id="create-supplemental">
          <i class="fa-solid fa-plus"></i> Add New
        </a>
    </div>
    @include('admin.pr.pr_table', ['name' => $status, 'creator' => 'create_user_vbtn'])
</section>
@endsection
@section('custom_js')
    @vite(['resources/js/PR/index.js'])
@endsection