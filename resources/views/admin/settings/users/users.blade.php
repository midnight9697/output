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
           usersClass.getUsers(fetchUsers);
            $('#create_user_vbtn').on('click', UserMod.createUserAction)
            $('#division').on('change', UserMod.sectionGetAction)
            $('#formCreateUser').on('submit', UserMod.createUser)
            $('#createUserFinalize').on('click', () =>  { $('#formCreateUser').trigger('submit') });
            $('.ui.form')
            .form({
              fields: {
                firstname     : 'empty',
                middlename   : 'empty',
                lastname : 'empty',
                email : 'empty',
                position : 'empty',
                division : 'empty',
                section : 'empty',
              }
            });
        })

        function fetchUsers(users) {
          users = users.data;     
          console.log(users);
               
          let ht = "";

          users.forEach(user => {
            ht += `
              <div class="two wide computer eight wide tablet sixteen wide mobile column">
                  <div class="ui card">
                      <div class="ui slide masked reveal image">
                          <div class="ui fade reveal">
                              <div class="visible content">
                                  <img src="{{ url('files/images/square-image.png') }}" class="visible content">
                              </div>
                              <div class="hidden content">
                                  <img src="{{ url('files/images/middle.avif') }}" class="visible content">
                              </div>
                          </div>
                      </div>
                      <div class="content">
                          <a class="header">${user.profile.firstname+" "+user.profile.middlename.charAt(0).toUpperCase()+"."+" "+user.profile.lastname}</a>
                          <div class="meta">
                            <span class="description">Computer Programmer</span>
                          </div>
                      </div>
                  </div>
              </div>
            `;
          });
          
          usersElement.innerHTML = ht;
        }

    </script>
@endsection