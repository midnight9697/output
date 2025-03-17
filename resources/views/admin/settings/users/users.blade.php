@extends('layout.app')

@section('main_content')
<div class="ui grid stackable padded users_content">
    
</div>
@endsection

@section('custom_js')
    <script>
        const usersClass = new Users();
        const usersElement = document.getElementsByClassName('users_content')[0];
        document.addEventListener('DOMContentLoaded', () => {
           usersClass.getUsers(fetchUsers);
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
                          <a class="header">${user.profile.lastname+", "+user.profile.firstname+" "+user.profile.middlename.charAt(0).toUpperCase()+"."}</a>
                          <div class="meta">
                            <span class="description">Computer Programmer</span>
                          </div>
                      </div>
                      <div class="extra content">
                          <a>
                            <i class="users icon"></i>
                              PISMU
                          </a>
                      </div>
                  </div>
              </div>
            `;
          });

          usersElement.innerHTML = ht;
        }
    </script>
@endsection