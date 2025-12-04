@extends('layout.app')

@section('extra_content')

@endsection

@section('main_content')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<style>
  /* --- HEADER --- */
  .table-header {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      margin-bottom: 10px;
  }

  .left-buttons {
      display: flex;
      align-items: center;
  }

  .right-search {
      margin-left: auto !important;
  }

  /* --- FOOTER --- */
  .table-footer {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      margin-top: 10px;
  }

  .left-info {
      display: flex;
      align-items: center;
  }

  .right-pagination {
      margin-left: auto !important;
      display: flex;
      align-items: center;
  }

  /* Ensure pagination aligns right */
  .dataTables_paginate {
      text-align: right !important;
  }

</style>
@include('admin.settings.users.modal')
  
  <table class="ui celled table" id="users_list_table" style="width: 100%">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last name</th>
        <th>Division</th>
        <th>Section</th>
        <th>Registered Date</th>
      </tr>
    </thead>
    <tbody class="users_content">
      <tr>
        <th colspan="7" style="text-align:center">Please wait...</th>
      </tr>
    </tbody>
  </table>
 
@endsection

@section('custom_js')
@vite(['resources/js/User/Index.js'])
@endsection