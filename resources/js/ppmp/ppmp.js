class PPMP {
    fetch_by_page(action, fail) {
        var usersClone = this;
        this.customGetRequest('./api/ppmp', action, fail);
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
}

export const ppmpController = new PPMP();