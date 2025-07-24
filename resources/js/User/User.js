import { BtnLoader, CustomDate, Message, Section } from "../app";
import { CustomTable } from "../custom_table";
import Validator from "./Validation";

const SectionMod = new Section;
const MessageMod = new Message;
const BtnLoaderMod = new BtnLoader();
const humanDate = new CustomDate();
const usersTable = new CustomTable('users_table', [
  'Name', 'Address', 'Gender', 'Sex'
], {
  name: 'Marco Pantonial', address: 'Tacloban City', gender: 'Male', sex: 'None'
}, [
  'name', 'address', 'gender', 'sex'
]);
var user_controller = null;
const maxActivePage = 5-1;
export const GValidator = new Validator;

export class Users {
    constructor() {
        const users = [];
    }

    getByPage(action, page = false) {
        var usersClone = this;
        axios.get('./api/users/getpage?'+(page?"page="+page:""))
          .then(function (response) {
            usersClone.users = response.data;
            action(response.data)
          });
    }

    getAllUsers(action, page = false) {
      var usersClone = this;
      axios.get('./api/users/all?')
        .then(function (response) {
          usersClone.users = response.data;
          action(response.data)
        });
  }

    createUser(user, action, fail) {
      var usersClone = this;
      axios.post('./api/users/insert', user, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }
}

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

  createUser(e) {
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
    
    new Users().createUser(user, (json) => {
      BtnLoaderMod.load(document.getElementById('createUserFinalize'), () => {
        new UserController().failedCreate();
        new Users().getByPage(new UserController().fetchUsersTable);
        MessageMod.success("User Successfully Created");
      });
    }, (response) => {
        BtnLoaderMod.load(document.getElementById('createUserFinalize'), () => {
          $('#formCreateUser .message').html('');
          $('#formCreateUser :input').prop('readonly', false);
          MessageMod.fail(response.message);
        });
    });
  }
  
  failedCreate() {
    $('#formCreateUser').form('reset');
    $('#formCreateUser .message').html('');
    $('#formCreateUser :input').prop('readonly', false);
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
    console.log(users);
    // usersTable.load();
    // return 0;
    
    let ht = "";

    users.forEach(user => {
      content.push({
        title: user.profile.firstname+" "+(user.profile.middlename == "waived"?"":user.profile.middlename.charAt(0).toUpperCase()+".")+" "+user.profile.lastname
      });

      $('.ui.search_people').search({
        source: content
      });

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
        </tr>
      `;
    });
    
    let prevBtn = document.createElement('a');
    prevBtn.className = `icon item ${(data.current_page == 1?"":"prev-page")}`;
    prevBtn.innerHTML = `<i class="left chevron icon"></i>`;
    prevBtn.onclick =  function(e) {
      if (data.current_page == 1) {
        return 0;
      }
      new Users().getByPage((paging) => {
          user_controller.fetchUsersTable(paging)
      },  data.current_page - 1);
    }

    let nextBtn = document.createElement('a');
    nextBtn.className = `icon item ${(data.current_page == data.last_page?"":"next-page")}`;
    nextBtn.innerHTML = `<i class="right chevron icon"></i>`;
    nextBtn.onclick =  function(e) {
      if (data.current_page == data.last_page) {
        return 0;
      }
      new Users().getByPage((paging) => {
          user_controller.fetchUsersTable(paging)
      },  data.current_page + 1);
    }

    let div = document.createElement('div')
    div.className = 'ui right floated pagination menu';
    div.appendChild(prevBtn);

    let page = "";
    let maxPage = (data.last_page >= maxActivePage?maxActivePage:data.last_page);
    let startPage = (data.last_page >= maxActivePage?(data.current_page):1);
    console.log('Start - Max: ', startPage, maxPage);
    if ((startPage+maxActivePage) < data.last_page) {
        maxPage = startPage + maxActivePage;
    }
    else {
      maxPage = (startPage + (data.last_page - startPage));
      startPage = startPage - ((maxActivePage + startPage) - data.last_page);
    }
    console.log('Start - Max: ', startPage, maxPage);

    for (let p = startPage; p <=  maxPage; p++) {
      let anchor = document.createElement('a');
      anchor.className = `${(data.current_page == p?'active':'')} item`;
      anchor.innerHTML = p;
      anchor.onclick = function() {
        new Users().getByPage((paging) => {
            user_controller.fetchUsersTable(paging)
        },  p);
      }
      div.appendChild(anchor);
    }
    div.appendChild(nextBtn);
    document.getElementById('page_content').innerHTML = "";
    document.getElementById('page_content').appendChild(div);
    usersElement.innerHTML = ht;
  }
  
}

