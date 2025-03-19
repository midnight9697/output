@extends('layout.app')

@section('extra_content')
  <button class="ui primary button" id="create_user_vbtn">Create User</button>
@endsection
@section('main_content')
@include('admin.settings.users.modal')
<div class="ui grid stackable padded users_content">

</div>
@endsection

@section('custom_js')
    <script>
        const usersClass = new Users();
        const usersElement = document.getElementsByClassName('users_content')[0];
        document.addEventListener('DOMContentLoaded', () => {
          
          usersClass.getUsers((users) => {
            GValidator.StoreUserValidation(users);
            UserMod.fetchUsers(users)
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