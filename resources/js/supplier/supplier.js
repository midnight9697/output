export class Supplier {

  remove(id, action, fail = () => {}) {
    var suppliersClone = this;
    let fd = new FormData();
    fd.append('id', id);
    axios.post('./api/supplier/remove', fd, {
        headers: {
          'Content-Type': 'application/json; charset=utf-8',
          'Accept': 'application/vnd.github+json',
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`
          // 'responseType': 'application/json',
        },
      })
      .then(action).catch(fail);
}

fetchSuppliers(id, action = () => {}, fail = () => {}) {
  var suppliersClone = this;
  this.customGetRequest('./api/supplier', action, fail);
}

updateSupplier(data, action = () => {}, fail = () => {}) {
  var suppliersClone = this;
  this.customPostRequest('./api/supplier/update', data, action, fail);
}

createSupplier(data, action = () => {}, fail = () => {}) {
  var suppliersClone = this;
  this.customPostRequest('./api/supplier/create', data, action, fail);
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

export const SupplierClass = new Supplier();