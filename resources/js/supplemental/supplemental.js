export class Supplemental {

    remove(id, action, fail = () => {}) {
      var usersClone = this;
      let fd = new FormData();
      fd.append('id', id);
      axios.post('./api/supplemental/remove', fd, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail);
  }

  fetchSupplemental(id, action = () => {}, fail = () => {}) {
    var usersClone = this;
    this.customGetRequest('./api/supplemental/'+id, action, fail);
  }
  
  updateSupplemental(data, action = () => {}, fail = () => {}) {
    var usersClone = this;
    this.customPostRequest('./api/supplemental/update', data, action, fail);
  }
  
  createSupplemental(data, action = () => {}, fail = () => {}) {
    var usersClone = this;
    this.customPostRequest('./api/supplemental/create', data, action, fail);
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

export const SupplementalControl = new Supplemental();