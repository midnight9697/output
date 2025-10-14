class AbstractModel {
    fetch_by_page(action, fail) {
        var usersClone = this;
        this.customGetRequest('./api/abstract', action, fail);
    }

    remove(ppmpid, action, fail) {
        var usersClone = this;
        this.customPostRequest('./api/abstract/remove', {id: ppmpid}, action, fail);
    } 

    create(data, action, fail) {
        var usersClone = this;
        let fd = new FormData();
        fd.append('att_file', data, data.name);
        fd.append('filename', data.name);
        this.customPostURequest('./api/abstract/create', fd, action, fail);
    }

    customGetRequest(url, action, fail = () => {}) {
        axios.get(url, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`,
          'responseType': 'application/json',
        }
      })
      .then((e) => {
        action(e.data);
      } )
    }
    
    customPostRequest(url, data, action, fail = () => {}) {
        axios.post(url, data, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    customPostURequest(url, data, action, fail = () => {}) {
        axios.post(url, data, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
          },
        })
        .then(action).catch(fail)
    }
}

export const abstractController = new AbstractModel();