export class Supplemental {


    upload(data, action, progress, fail = () => {}) {
        var usersClone = this;
        axios.post('./api/supplemental/upload/temporary', data, {
            headers: {
              'Content-Type': 'application/json; charset=utf-8',
              'Accept': 'application/vnd.github+json',
              'Authorization': `Bearer ${localStorage.getItem('bearer')}`
              // 'responseType': 'application/json',
            },
            onUploadProgress: (progressEvent) => {
              const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
              progress(percentCompleted);
            }
          })
          .then(action).catch(fail);
    }
}

export const SupplementalControl = new Supplemental();