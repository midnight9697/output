import { SectionMod, MessageMod, BtnLoaderMod, humanDate  } from "../app";
import { paginateMod } from "../login/pagination";
import { usersClass } from "./User";
import { GValidator } from "./Validation";

var user_controller = null;


export class UserController {

    constructor() {
      user_controller = this;
      this.btnCreateFinalize = document.getElementById('createUserFinalize');
      // content = [];
      // usersElement = document.getElementsByClassName('users_content')[0];
    }
    
    getSection(sections) {
      let ht = "";
  
      sections.forEach(section => {
        ht += `
          <option value="${section.id}">${section.section}</option>
        `;
      });
      document.getElementById('section').innerHTML = ht;
    }
    
    createUser(e, table) {

      e.preventDefault();
      let user = {};
      if (!GValidator.form.form('is valid')) {  // Reject Process if all fields are not filled
        return 0;
      }
      $('#formCreateUser :input').prop('readonly', true);
      BtnLoaderMod.start(new UserController().btnCreateFinalize);
      $('#formCreateUser').serializeArray().forEach(data => {
        user[data.name] = data.value;
      });
      
      usersClass.createUser(user, (json) => {
        BtnLoaderMod.load(document.getElementById('createUserFinalize'), () => {
          new UserController().failedAction('formCreateUser');
          table.table.ajax.reload();
          MessageMod.success("User Successfully Created");
        }, "REGISTER USER");
      }, (response) => {
          BtnLoaderMod.load(document.getElementById('createUserFinalize'), () => {
            $('#formCreateUser .message').html('');
            $('#formCreateUser :input').prop('readonly', false);
            MessageMod.fail(response.message);
          }, "REGISTER USER");
      });
    }

    failedAction(element) {
      $('#'+element).form('reset');
      $('#'+element+' .message').html('');
      $('#'+element+' :input').prop('readonly', false);
    }

    createUserAction() {
      var CUserController = new UserController(); 
      SectionMod.getSection($('#division').val(), CUserController.getSection);
      $('#modalCreate').modal('show');
    }

    sectionGetAction(e) {
      var CUserController = new UserController(); 
      SectionMod.getSection(e.target.value, CUserController.getSection);
    }
    
    fetchUsers(users) {
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
                              <img src="files/images/square-image.png" class="visible content">
                          </div>
                          <div class="hidden content">
                              <img src="files/images/middle.avif" class="visible content">
                          </div>
                      </div>
                  </div>
                  <div class="content">
                      <a class="header truncate">${user.profile.firstname+" "+user.profile.middlename.charAt(0).toUpperCase()+"."+" "+user.profile.lastname}</a>
                      <div class="meta">
                        <span class="description truncate">${user.profile.position}</span>
                      </div>
                  </div>
              </div>
          </div>
        `;
      });
      
      usersElement.innerHTML = ht;
    }
    
    fetchUsersTable(users) {
      const usersElement = document.getElementsByClassName('users_content')[0];
      var content = [];
  
      let data = users;
      users = users.data;     
      
      let ht = "";
      
      users.forEach(user => {
        content.push({
          title: user.profile.firstname+" "+(user.profile.middlename == "waived"?"":user.profile.middlename.charAt(0).toUpperCase()+".")+" "+user.profile.lastname
        });
  
        // $('.ui.search_people').search({
        //   source: content
        // });
  
        ht += `
          <tr>
            <td>
              <h4 class="ui image header">
                <img src="files/images/square-image.png" class="ui mini rounded image">
                <div class="content">
                  ${user.profile.firstname+" "+(user.profile.middlename == "waived"?"":user.profile.middlename.charAt(0).toUpperCase()+".")+" "+user.profile.lastname}
                  <div class="sub header">
                    ${user.profile.position}
                  </div>
                </div>
              </h4>
            </td>
            <td>
              ${user.profile.division.division}
            </td>
            <td>
              ${user.profile.section.section}
            </td>
            <td>
              ${humanDate.humanDate(user.created_at, 's')}
            </td>
            <td>
              <a href="./users/${user.id}/edit" class="ui button positive tiny user-update-button" data-userid="${user.id}">UPDATE</a>
            </td>
          </tr>
        `;
      });
      paginateMod.load(document.getElementById('page_content'), data, user_controller.fetchUsersTable, './api/users/getpage');
      usersElement.innerHTML = ht;
    }
}

export const UserMod = new UserController();