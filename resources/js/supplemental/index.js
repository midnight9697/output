import { MessageMod, confirmMod, createElement, progressControl, uploadControl } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { SupplementalControl } from "./supplemental";
let SPLTBL = {};
document.addEventListener('DOMContentLoaded', () => {

  SPLTBL = new Custom_table('#splTable', false, true, false, false, './api/supplemental/page');
  SPLTBL.dataSrc = (json) => {
      return json.data;
  }

  SPLTBL.custom_buttons = (data) => {
    let div = document.createElement('div');
    TBLButton.data = data;
    TBLButton.downAction = "./supplemental/view/"+data.id;

    TBLButton.deleteAction = (e) => {
      confirmMod.load(() => {
        let spl_id = e.target.dataset.id;
        SupplementalControl.remove(spl_id, (e) => {
          SPLTBL.table.ajax.reload();
        });
      }, "Do you want to delete this file ?");
    }
    TBLButton.loadButtons(div);
    return div;
  };
  
  SPLTBL.load([
      'filename',
      'origin',
      'title',
      'user_id',
      'created_at',
  ]);

  // SPLTBL.table

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

export function filePreview(files, parent = document.getElementById('files-preview')) {
  const supplementalPreview = parent;
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