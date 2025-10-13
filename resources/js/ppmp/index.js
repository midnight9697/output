import { MessageMod, confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { ppmpController } from "./ppmp";

document.addEventListener('DOMContentLoaded', () => {
    const active_table = new Custom_table('#ppmp-table', false, true, false, false, './api/ppmp/page')

    $('#create_ppmp_vbtn').on('click', () => {
        $('#uploadPPMPModal').modal('show');
    });

    active_table.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        
        TBLButton.updateAction =  () => {
          alert('Shity');
        }
        
        TBLButton.deleteAction = (e) => {
          confirmMod.load(() => {
            let spl_id = e.target.dataset.id;
            ppmpController.remove(spl_id, (e) => {
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

