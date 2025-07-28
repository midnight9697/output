export class PurchaseRequests {
    
    getByPage(action, page = false) {
      console.log('local', localStorage.getItem('bearer'));
      axios.get('./api/pr/page?+(page?"page="+page:""', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`
        }
      })
      .then((e) => {
        action(e.data.data);
      } )
    }
}

export var PRClass = new PurchaseRequests();