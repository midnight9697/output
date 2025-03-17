class Users {
    constructor() {
        const users = [];
    }

    getUsers(action) {
        var usersClone = this;
        axios.get('./users/list')
          .then(function (response) {
            usersClone.users = response.data;
            action(response.data)
          });
    }

    createUser(user, action) {
      var usersClone = this;
        axios.post('./users/insert', user, {
            headers: {
              'Content-Type': 'application/json; charset=utf-8',
              'Accept': 'application/vnd.github+json',
              // 'responseType': 'application/json',
            },
          })
          .then(function (response) {
            usersClone.users = response.data;
            // action(response.data);
          }).catch((err) => {
            const contentType = err;
            console.log('Shit', contentType);
          })
    }
}

class UserController {

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
    $('#formCreateUser').serializeArray().forEach(data => {
      user[data.name] = data.value;
    });
    new Users().createUser(user, (json) => {
      console.log('json', json);
    });
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
  
}

const UserMod = new UserController();