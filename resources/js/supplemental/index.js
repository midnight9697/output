import { progressControl, uploadControl } from "../app";
document.addEventListener('DOMContentLoaded', () => {
    $('#create-supplemental').on('click', () => {
      $('#modalUploadSupplemental').modal('show');
    })

    $('#supplemental').on('change', () => {
      const supplementalFile = document.getElementById('supplemental');
      const supplementalPreview = document.getElementById('files-preview');
      supplementalPreview.innerHTML = "";
      let ui_list = document.createElement('div');
      ui_list.className = "ui list";
      let ht = ``;
      supplementalFile.files.forEach(file => {
        ht += `
          <div class="item">
            <i class="file icon"></i>
            <div class="content">
              <div class="description">${file.name}</div>
            </div>
          </div>
        `;
      });

      ui_list.innerHTML = ht;
      supplementalPreview.appendChild(ui_list);
    })

    $('#upload-file-button').on('click', () => {
      const supplementalFile = document.getElementById('supplemental');
      progressControl.make('progress-section');
      var fcount = 0;
      if (supplementalFile.files.length > 0) {
        uploadFile(supplementalFile, fcount)
      }// If Statement
    });// onclick event upload-file-button
});// DOMContentLoaded Endpoint

function uploadFile(supplementalFile, fcount) {
  uploadControl.upload('./api/supplemental/upload/temporary', supplementalFile.files[fcount], () => {
    console.log(fcount);
    
    fcount += 1;
    if (fcount < supplementalFile.files.length) {
      progressControl.make('progress-section');
      uploadFile(supplementalFile, fcount)
    }
  }, (progress) => {
    progressControl.progress(progress, (fcount+1)+' of '+supplementalFile.files.length);
    if (progress >= 100) {
      progressControl.success();
      
    }// If Statement
  }, () => {
    progressControl.fail();
  });// UploadControl Endpoint
}