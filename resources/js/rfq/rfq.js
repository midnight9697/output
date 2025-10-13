export class RFQ {
    fetch_rfq(data, action) {
        this.customPostRequest('./api/rfq/one', data, action, () => {});
    }
    
    inbox_rfq(action, page = false) {
        console.log('local', localStorage.getItem('bearer'));
        this.customGetRequest('./api/rfq/page'+(page?"?page="+page:""), action);
    }
    
    creatRFQ(data, action = () => {}, fail = () => {}) {
        var usersClone = this;
        this.customPostRequest('./api/rfq/create', data, action, fail);
    }

    updateRFQ(data, action = () => {}, fail = () => {}) {
      var usersClone = this;
      this.customPostRequest('./api/rfq/update', data, action, fail);
    }

    creatRFQTemplate(data, action = () => {}, fail = () => {}) {
        var usersClone = this;
        this.customPostRequest('./api/rfq/create_template', data, action, fail);
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

export const rfqClass = new RFQ();