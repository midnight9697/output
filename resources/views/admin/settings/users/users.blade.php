@extends('layout.app')

@section('main_content')
@include('admin.settings.users.modal')
<div class="ui grid stackable padded">
  <table class="ui very basic collapsing celled table" style="width: 100%">
    <thead>
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
          <div class="ui small primary labeled icon button" id="create_user_vbtn">
            <i class="user icon"></i> Add User
          </div>
          
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
        document.addEventListener('DOMContentLoaded', () => {
          
          usersClass.getUsers((users) => {
            GValidator.StoreUserValidation(users);
            UserMod.fetchUsersTable(users)
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