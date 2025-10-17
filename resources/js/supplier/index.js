import { MessageMod, confirmMod, createElement, global_place, progressControl, uploadControl } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { SupplierClass } from "./supplier";
import { SupplierValidator } from "./validation";
let SPLTBL = {};
let selected_supplier = {};
document.addEventListener('DOMContentLoaded', () => {

  SPLTBL = new Custom_table('#supplier-inbox', false, true, false, false, './api/supplier/get_all_supplier');
  SPLTBL.dataSrc = (json) => {
      return json.data;
  }

    $('.submit_upload_button').on('click', () => {
    let data = {
        'supplier_name': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_name,
        'supplier_province': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_province,
        'supplier_municipality': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_municipality,
        'supplier_barangay': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_barangay,
    }
    data['id'] = selected_supplier

    SupplierClass.updateSupplier(data)
  });

  global_place('supplier_province', 'supplier_municipality', 'supplier_barangay')

  SPLTBL.custom_buttons = (data) => {
    let div = document.createElement('div');
    TBLButton.data = data;
    TBLButton.updateAction =  () => {
      selected_supplier = data.id;
      $('#supplier-update-modal').modal('show');
      $('#supplier_name').val(data.name)
      $('#supplier_province').dropdown('set selected', data.province);
      $('#supplier_municipality').dropdown('set selected', data.municipality);
      $('#supplier_barangay').dropdown('set selected', data.barangay);
    }

    TBLButton.deleteAction = (e) => {
      confirmMod.load(() => {
        let spl_id = e.target.dataset.id;
        SupplierClass.remove(spl_id, (e) => {
          SPLTBL.table.ajax.reload();
          MessageMod.success("Successfully Deleted.");
        });
      }, "Do you want to delete this file ?");
    }
    TBLButton.loadButtons(div);
    return div;
  };
  
  SPLTBL.load([
      'name',
      'municipality',
      // 'barangay, municipality, province',
      'created_at',
  ]);

  $('#Supplier').on('change', () => {
    const SupplierFile = document.getElementById('Supplier');
    filePreview(SupplierFile.files);
  });

  $('#upload-file-button').on('click', () => {
    const SupplierFile = document.getElementById('Supplier');
    progressControl.make('progress-section');
    var fcount = 0;
    if (SupplierFile.files.length > 0) {
      $('#modalUploadSupplier').modal('hide');
      uploadFile(SupplierFile, fcount)
    }// If Statement
  });// onclick event upload-file-button
});// DOMContentLoaded Endpoint

export function filePreview(files, parent = document.getElementById('files-preview')) {
  const SupplierPreview = parent;
  SupplierPreview.innerHTML = "";
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
  SupplierPreview.appendChild(ui_list);
}

function uploadFile(SupplierFile, fcount) {
  let current_file = SupplierFile.files[fcount];
  let fd = new FormData();
  fd.append('sup_file', current_file, current_file.name);
  fd.append('filename', current_file.name);
  fd.append('filetype', current_file.type);
  uploadControl.upload('./api/Supplier/upload', fd, (response) => {
    fcount += 1;
    if (fcount < SupplierFile.files.length) {
      progressControl.make('progress-section');
      progressControl.progress(0, (fcount+1)+' of '+SupplierFile.files.length);
      SPLTBL.table.ajax.reload(function() {
        setTimeout(() => {
          uploadFile(SupplierFile, fcount);
        }, 1000);
      });
    }
    else {
      SPLTBL.table.ajax.reload();
      MessageMod.success("All files have been uploaded successfully.");
      progressControl.make('progress-section');
    }
  }, (progress) => {
    progressControl.progress(progress, (fcount+1)+' of '+SupplierFile.files.length);
    if (progress >= 100) {
      progressControl.success();
    }// If Statement
  }, () => {
    MessageMod.fail("File too large.");
    progressControl.make('progress-section');
    progressControl.fail();
  });// UploadControl Endpoint
}

