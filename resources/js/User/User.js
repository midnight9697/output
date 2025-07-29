

export class Users {
    constructor() {
        const users = [];
    }

    getByPage(action, page = false) {
        var usersClone = this;
        axios.get('./api/users/getpage?'+(page?"page="+page:""),  {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
          }
        })
          .then(function (response) {
            usersClone.users = response.data;
            action(response.data)
          });
    }

    searchQuery(action, query) {
      var usersClone = this;
      axios.post('./api/users/search', {
        'query': query
      })
        .then(function (response) {
          usersClone.users = response.data;
          action(response.data)
        });
  }

    getAllUsers(action, page = false) {
      var usersClone = this;
      axios.get('./api/users/all?', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`
        }
      })
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
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    updateUser(user, action, fail) {
      var usersClone = this;
      axios.post('./api/users/'+user.id+'/edit', user, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }
}

export const usersClass = new Users();

