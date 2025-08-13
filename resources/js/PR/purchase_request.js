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
}

export var PRClass = new PurchaseRequests();