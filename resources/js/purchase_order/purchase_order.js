export class PurchaseOrder {

    remove(id, action, fail = () => {}) {
      let fd = new FormData();
      fd.append('id', id);
      axios.post('./api/purchase_order/remove', fd, {
          headers: {
            'Content-Type': 'application/json; charset=utf-8',
            'Accept': 'application/vnd.github+json',
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
            // 'responseType': 'application/json',
          },
        })
        .then(action).catch(fail);
    }

    fetch_purchase_order(data, action) {
        this.customPostRequest('./api/purchase_order/one', data, action, () => {});
    }

    fetch_suppliers(data, action) {
      this.customPostRequest('./api/purchase_order/fetch_suppliers', data, (response) => {
        action(response.data);
      });
    }
    
    select_supplier(data, action) {
      this.customPostRequest('./api/purchase_order/select_suppliers', data, (response) => {
        action(response);
      });
    }

    counter(action) {
        this.customGetRequest('./api/purchase_order/counter', action, () => {});
    }
    
    inbox_purchase_order(action, page = false) {
        console.log('local', localStorage.getItem('bearer'));
        this.customGetRequest('./api/purchase_order/page'+(page?"?page="+page:""), action);
    }
    
    creatpurchase_order(data, action = () => {}, fail = () => {}) {
        var usersClone = this;
        this.customPostRequest('./api/purchase_order/create', data, action, fail);
    }

    getAlternativeId(id, action = () => {}, fail = () => {}) {
        var usersClone = this;
        this.customPostRequest('./api/alternative', {'id': id}, action, fail);
    }

    updatepurchase_order(data, action = () => {}, fail = () => {}) {
      var usersClone = this;
      this.customPostRequest('./api/purchase_order/update', data, action, fail);
    }

    creatpurchase_orderTemplate(data, action = () => {}, fail = () => {}) {
        var usersClone = this;
        this.customPostRequest('./api/purchase_order/create_template', data, action, fail);
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
          'Authorization': `Bearer ${localStorage.getItem('bearer')}`
        }
      })
      .then((e) => {
        action(e.data.data);
      } )
    }
}

export const PurchaseOrderClass = new PurchaseOrder();