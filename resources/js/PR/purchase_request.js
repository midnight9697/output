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
}

export var PRClass = new PurchaseRequests();