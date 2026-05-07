class IEPMC {
    fetch_by_page(action, fail) {
        var usersClone = this;
        this.customGetRequest('./api/iepmc', action, fail);
    } 

    fetch_item(item_id, action, fail) {
        var usersClone = this;
        this.customGetRequest('./api/iepmc/item/'+item_id, action, fail);
    }

    remove(ppmpid, action, fail) {
        var usersClone = this;
        this.customPostRequest('./api/iepmc/remove', {id: ppmpid}, action, fail);
    } 

    update(data, blob,action, fail) {
        data['iepmc_id'] = data.id;
        var usersClone = this;
        const formData = new FormData();
        Object.keys(data).forEach(key => {
          formData.append(key, data[key]);
        });
        const filename = `iepmc-template-report-${Date.now()}.docx`; // unique filename
        formData.append("iepmc_file", blob, filename);
        this.customPostURequest('./api/iepmc/update', formData, action, fail);
    } 

    create(data, blob, action, fail) {
        var usersClone = this;
        const formData = new FormData();
        Object.keys(data).forEach(key => {
          formData.append(key, (key=='items'?JSON.stringify(data[key]):data[key]));
        });
        const filename = `iepmc-template-report-${Date.now()}.docx`; // unique filename
        formData.append("iepmc_file", blob, filename);
        this.customPostURequest('./api/iepmc/create', formData, action, fail);
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

    customPostURequest(url, data, action, fail = () => {}) {
        axios.post(url, data, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('bearer')}`
          },
        })
        .then(action).catch(fail)
    }
}

export const iepmcController = new IEPMC();