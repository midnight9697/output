import { MessageMod, confirmMod, uploadControl } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { ppmpController } from "./ppmp";
import { ppmpValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {
    const active_table = new Custom_table('#ppmp-table', false, true, false, false, './api/ppmp/page')

    ppmpValidator.CreatePPMPValidation((e) => {
        e.preventDefault();
        const files = document.getElementById('files').files;
        let count = 0;
        MessageMod.success("Uploading File...");
        uploadFile(files, count);
    },'form-upload-ppmp');
    
    $('.submit_upload_button').on('click', () => {
        $('.form-upload-ppmp').trigger('submit');
    });

    $('#create_ppmp_vbtn').on('click', () => {
        $('#uploadPPMPModal').modal('show');
    });
    
    active_table.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        
        TBLButton.deleteAction = (e) => {
          confirmMod.load(() => {
            let ppmp__id = e.target.dataset.id;
            ppmpController.remove(ppmp__id, (e) => {
              active_table.table.ajax.reload();
              MessageMod.success("Successfully Deleted.");
            });
          }, "Do you want to delete this file ?");
        }
        TBLButton.loadButtons(div);
        return div;
    };

    active_table.load([
        'ref',
        'title',
        'created_at',
    ]);
});

function uploadFile(files, count) {
    uploadControl.upload('./api/ppmp/create', files[count], () => {
        count = count + 1;
        if (count < files.length) {
            uploadFile(files, count);
        }
        else {
            MessageMod.success('Successfully Uploaded');
        }
    })
}