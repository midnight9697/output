

class Users {
    constructor() {
        const users = [];
    }

    getUsers(action, page = false) {
        var usersClone = this;
        axios.get('./users/list?'+(page?page:""))
          .then(function (response) {
            usersClone.users = response.data;
            action(response.data)
          });
    }

    createUser(user, action, fail) {
      var usersClone = this;
        axios.post('./users/insert', user, {
            headers: {
              'Content-Type': 'application/json; charset=utf-8',
              'Accept': 'application/vnd.github+json',
              // 'responseType': 'application/json',
            },
          })
          .then(action).catch(fail)
    }
}

class UserController {

  constructor() {
    this.btnCreateFinalize = document.getElementById('createUserFinalize');
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
    $('#formCreateUser :input').prop('readonly', true);
    BtnLoaderMod.start(new UserController().btnCreateFinalize);
    $('#formCreateUser').serializeArray().forEach(data => {
      user[data.name] = data.value;
    });
    new Users().createUser(user, (json) => {
      BtnLoaderMod.load(document.getElementById('createUserFinalize'), () => {
        new UserController().failedCreate();
        new Users().getUsers(new UserController().fetchUsersTable);
        MessageMod.success("User Successfully Created");
      });
    }, (response) => {
        BtnLoaderMod.load(document.getElementById('createUserFinalize'), () => {
          $('#formCreateUser .message').html('');
          $('#formCreateUser :input').prop('readonly', false);
          MessageMod.fail("Server Error");
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
    let data = users;
    users = users.data;     
    console.log(users);
    
    let ht = "";

    users.forEach(user => {
      content.push({
        title: user.profile.firstname+" "+user.profile.middlename.charAt(0).toUpperCase()+"."+" "+user.profile.lastname
      });

      $('.ui.search_people').search({
        source: content
      })
      ht += `
        <tr>
          <td>
            <h4 class="ui image header">
              <img src="files/images/square-image.png" class="ui mini rounded image">
              <div class="content">
                ${user.profile.firstname+" "+user.profile.middlename.charAt(0).toUpperCase()+"."+" "+user.profile.lastname}
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
          </td>
        </tr>
      `;
    });
    console.log('data', data);
    let page = "";
    for (let p = 1; p <= 3; p++) {
      page += `
        <a class="${(data.current_page == p?'active':'')} item">
          ${p}
        </a>
      `;
    }
    document.getElementById('page_content').innerHTML = `
      <div class="ui right floated pagination menu">
            ${page}
      </div>
    `;
    usersElement.innerHTML = ht;
  }
  
}

const UserMod = new UserController();