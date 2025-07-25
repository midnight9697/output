@extends('layout.app')

@section('extra_content')

@endsection

@section('main_content')
@include('admin.settings.users.modal')
<div class="ui grid stackable padded" id="users_table">
  <table class="ui very basic collapsing celled table" style="width: 100%">
    <thead>
      <tr>
        <th colspan="5">
          <div class="ui right aligned grid">
            <div class="left floated left aligned six wide column">
                <div class="ui small primary labeled icon button" id="create_user_vbtn">
                  <i class="user icon"></i> REGISTER
                </div>
            </div>
            <div class="right floated right aligned six wide column">
                <div class="ui right aligned search search_people">
                  <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="Search People...">
                    <i class="search icon"></i>
                  </div>
                  <div class="results"></div>
                </div>
            </div>
          </div>
        </th>
      </tr>
      <tr>
        <th>Employee</th>
        <th>Division</th>
        <th>Section</th>
        <th>Registered Date</th>
      </tr>
    </thead>
    <tbody class="users_content">
      
    </tbody>
    <tfoot class="full-width">
      <tr>
        <th>
        </th>
        <th colspan="4" id="page_content">
          <div class="ui right floated pagination menu">
            <a class="icon item">
              <i class="left chevron icon"></i>
            </a>
            <a class="active item">
              1
            </a>
            <div class="disabled item">
              ...
            </div>
            <a class="item">
              10
            </a>
            <a class="item">
              11
            </a>
            <a class="item">
              12
            </a>
            <a class="icon item">
              <i class="right chevron icon"></i>
            </a>
          </div>
        </th>
      </tr>
    </tfoot>
  </table>
 
</div>
@endsection

@section('custom_js')
@vite(['resources/js/User/Index.js'])
  <script>
      
  </script>
@endsection