import { MessageMod, confirmMod, uploadControl } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { appController } from "./app";
import { appValidator } from "./validation";
var active_table = null;
document.addEventListener('DOMContentLoaded', () => {
    active_table = new Custom_table('#app-table', false, true, false, false, './api/app/page')

    appValidator.CreateAPPValidation((e) => {
        e.preventDefault();
        const files = document.getElementById('files').files;
        let count = 0;
        MessageMod.success("Uploading File...");
        uploadFile(files, count);
    },'form-upload-app');
    
    $('.submit_upload_button').on('click', () => {
        $('.form-upload-app').trigger('submit');
    });

    $('#create_app_vbtn').on('click', () => {
        $('#uploadAPPModal').modal('show');
    });
    
    active_table.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        
        TBLButton.deleteAction = (e) => {
          confirmMod.load(() => {
            let ppmp__id = e.target.dataset.id;
            appController.remove(ppmp__id, (e) => {
              active_table.table.ajax.reload();
              MessageMod.success("Successfully Deleted.");
            });
          }, "Do you want to delete this file ?");
        }
        TBLButton.loadButtons(div);
        return div;
    };

    active_table.load([
        'filename',
        'title',
        'created_at',
    ]);
});

function uploadFile(files, count) {
    appController.create(files[count], () => {
        active_table.table.ajax.reload();
        count = count + 1;
        if (count < files.length) {
            uploadFile(files, count);
        }
        else {
            MessageMod.success('Successfully Uploaded');
            MessageMod.hide();
        }
    });
}