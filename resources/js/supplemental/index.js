import { MessageMod, createElement, progressControl, uploadControl } from "../app";
import Custom_table from "../table/custom_table";
let SPLTBL = {};
document.addEventListener('DOMContentLoaded', () => {

  SPLTBL = new Custom_table('#splTable', false, true, false, false, './api/supplemental/page');
    
  SPLTBL.custom_buttons = function(data) {
    let div = createElement("", "", "div");
    let button = createElement("ui very small red button", "REMOVE", "button", function() {
      console.log('Clicked', data);
    });
    div.appendChild(button);
    return div;
  };
  
  SPLTBL.load([
      'filename',
      'origin',
      'title',
      'user_id',
      'created_at',
  ]);
  
  $('#create-supplemental').on('click', () => {
    $('#modalUploadSupplemental').modal('show');
  });

  $('#supplemental').on('change', () => {
    const supplementalFile = document.getElementById('supplemental');
    filePreview(supplementalFile.files);
  });

  $('#upload-file-button').on('click', () => {
    const supplementalFile = document.getElementById('supplemental');
    progressControl.make('progress-section');
    var fcount = 0;
    if (supplementalFile.files.length > 0) {
      $('#modalUploadSupplemental').modal('hide');
      uploadFile(supplementalFile, fcount)
    }// If Statement
  });// onclick event upload-file-button
});// DOMContentLoaded Endpoint

function filePreview(files) {
  const supplementalPreview = document.getElementById('files-preview');
  supplementalPreview.innerHTML = "";
  let ui_list = document.createElement('div');
  ui_list.className = "ui list";
  let ht = "";
  files.forEach(file => {
    ht += `
      <div class="item">
        <i class="file icon"></i>
        <div class="content">
          <a ${file.url?"href='"+file.url+"'":""} class="description">${file.name}</a>
        </div>
      </div>
    `;
  });
  ui_list.innerHTML = ht;
  supplementalPreview.appendChild(ui_list);
}

function uploadFile(supplementalFile, fcount) {
  let current_file = supplementalFile.files[fcount];
  let fd = new FormData();
  fd.append('sup_file', current_file, current_file.name);
  fd.append('filename', current_file.name);
  fd.append('filetype', current_file.type);
  uploadControl.upload('./api/supplemental/upload', fd, (response) => {
    fcount += 1;
    if (fcount < supplementalFile.files.length) {
      progressControl.make('progress-section');
      progressControl.progress(0, (fcount+1)+' of '+supplementalFile.files.length);
      SPLTBL.table.ajax.reload(function() {
        setTimeout(() => {
          uploadFile(supplementalFile, fcount);
        }, 1000);
      });
    }
    else {
      SPLTBL.table.ajax.reload();
      MessageMod.success("All files have been uploaded successfully.");
      progressControl.make('progress-section');
    }
  }, (progress) => {
    progressControl.progress(progress, (fcount+1)+' of '+supplementalFile.files.length);
    if (progress >= 100) {
      progressControl.success();
    }// If Statement
  }, () => {
    MessageMod.fail("File too large.");
    progressControl.make('progress-section');
    progressControl.fail();
  });// UploadControl Endpoint
}