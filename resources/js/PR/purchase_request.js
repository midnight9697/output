export class PurchaseRequests {
    
    getByPage(action, page = false) {
      console.log('local', localStorage.getItem('bearer'));
      axios.get('./api/pr/list?+(page?"page="+page:""', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`
        }
      })
      .then(action)
    }
}

export var PRClass = new PurchaseRequests();