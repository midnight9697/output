class PScoping {
    fetch_by_page(action, fail) {
        var usersClone = this;
        this.customGetRequest('./eia_corner/ps-data', action, fail);
    } 

    insert(data,action, fail) {
      this.customPostURequest('./eia_corner/scoping/insert', data, action, fail);
    }
    
    update(data,action, fail) {
      this.customPostURequest('./eia_corner/scoping/update', data, action, fail);
    }

    remove(data,action, fail) {
      this.customPostURequest('./eia_corner/scoping/remove', {id: data}, action, fail);
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

export const scopingController = new PScoping();