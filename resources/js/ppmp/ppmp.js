class PPMP {
    fetch_by_page(action, fail) {
        var usersClone = this;
        this.customGetRequest('./api/ppmp', action, fail);
    } 

    remove(ppmpid, action, fail) {
        var usersClone = this;
        this.customPostRequest('./api/ppmp/remove', {id: ppmpid}, action, fail);
    } 

    create(data, action, fail) {
        var usersClone = this;
        let fd = new FormData();
        console.log(data);
        fd.append('att_file', data, data.name);
        fd.append('filename', data.name);
        this.customPostURequest('./api/ppmp/create', fd, action, fail);
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

export const ppmpController = new PPMP();