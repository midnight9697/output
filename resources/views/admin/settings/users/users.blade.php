@extends('layout.app')

@section('extra_content')

@endsection

@section('main_content')
@include('admin.settings.users.modal')
<div class="ui grid stackable padded">
  <table class="ui very basic collapsing celled table" style="width: 100%">
    <thead>
      <tr>
        <th colspan="5">
          <div class="ui right aligned grid">
            <div class="left floated left aligned six wide column">
                <div class="ui small primary labeled icon button" id="create_user_vbtn">
                  <i class="user icon"></i> Add User
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
          {{-- Extra Content --}}
        </th>
        <th colspan="4" id="page_content">
          <div class="ui right floated pagination menu">
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
          </div>
        </th>
      </tr>
    </tfoot>
  </table>
 
</div>
@endsection

@section('custom_js')
    <script>
        const usersClass = new Users();
        const usersElement = document.getElementsByClassName('users_content')[0];
        var content = [];
        document.addEventListener('DOMContentLoaded', () => {
          // Load all users for validation
          usersClass.getAllUsers((users) => {
            GValidator.StoreUserValidation(users);
          });
          // Load paginated users
          usersClass.getUsers((paging) => {
            UserMod.fetchUsersTable(paging)
          });
          $('#create_user_vbtn').on('click', UserMod.createUserAction)
          $('#division').on('change', UserMod.sectionGetAction)
          $('#formCreateUser').on('submit', UserMod.createUser)
          $('#createUserFinalize').on('click', () =>  { $('#formCreateUser').trigger('submit') });
          $('#show_password').on('change', () => {
            document.getElementById('password').type = ($('#show_password').is(':checked')?'text':'password');
            document.getElementById('password_confirmation').type = ($('#show_password').is(':checked')?'text':'password');
          });
        })
    </script>
@endsection