class Users {
    constructor() {
        const users = [];
    }

    getUsers(action) {
        var usersClone = this;
        axios.get('./users/list')
          .then(function (response) {
            console.log('Response', response);
            usersClone.users = response.data;
            action(response.data)
          });
    }
}