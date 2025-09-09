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
}

export const SupplementalControl = new Supplemental();