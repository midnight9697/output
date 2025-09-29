export class PurchaseRequests {
    
    getByPage(action, page = false) {
      console.log('local', localStorage.getItem('bearer'));
      axios.get('./api/pr/page'+(page?"?page="+page:""), {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`
        }
      })
      .then((e) => {
        action(e.data.data);
      } )
    }

    getPrItems(pr_id, action) {
      axios.get('./api/pr/'+pr_id+'/items', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`
        }
      })
      .then((e) => {
        action(e.data);
      } )
    }

    getDecryptAction(action_id, action) {
      axios.post('./api/pr/decrypt_action',{action:action_id,}, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`,
          'Content-Type': 'application/json; charset=utf-8',
          'Accept': 'application/vnd.github+json',
        }
      })
      .then((e) => {
        action(e.data);
      } )
    }



    creatPR(pr, items, action = () => {}, fail = () => {}) {
      var usersClone = this;
      pr['items'] = items;
      axios.post('./api/pr/create', pr, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    updatePR(pr, items, members, action = () => {}, fail = () => {}) {
      var usersClone = this;
      pr['items'] = items;
      pr['members'] = members;
      axios.post('./api/pr/'+localStorage.getItem('pr_id')+'/edit', pr, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    commentPR(data, action = () => {}, fail = () => {}) {
      var usersClone = this;
      data['pr_id'] = localStorage.getItem('pr_id');
      axios.post('./api/pr/comment', data, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    routePR(data, action = () => {}, fail = () => {}) {
      var usersClone = this;
      data['pr_id'] = localStorage.getItem('pr_id');
      axios.post('./api/pr/route', data, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    receivePR(data, action = () => {}, fail = () => {}) {
      var usersClone = this;
      axios.post('./api/pr/'+data.pr_id+"/receive", data, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    uploadAtt(file, action = () => {}, fail = () => {}) {
      axios.post('./api/pr/attachment/upload', file, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail)
    }

    generatePR(id, action = () => {}, fail = () => {}) {
      let fd = new FormData();
      fd.append('id', id);
      axios.post('./api/pr/generate_pr_number', fd, {
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

export var PRClass = new PurchaseRequests();