import { confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";

let equipmentTable;
let current_iepmc = null;
document.addEventListener('DOMContentLoaded', () => {
    equipmentTable = new Custom_table('#equipment-table', false, true, true, true, './api/equipment/page')
    
    equipmentTable.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        TBLButton.viewName = 'Download';
        TBLButton.viewAction = () => {
            window.location = 'iepmc/stream/2025/'+data.id;
        }

        TBLButton.deleteAction = (e) => {
          confirmMod.load(() => {
            let iepmc_id = e.target.dataset.id;
            equipmentTable.table.ajax.reload();
          }, "Do you want to delete this file ?");
        }

        TBLButton.updateAction = (e) => {
            iepmcController.fetch_item(data.id, (item) => {
                current_iepmc = item;
                document.getElementById('update-maintenance_form').innerHTML = updateIEPMCForm(item);
                $('#update-maintenanceModal').modal('show');
            })
        }
        TBLButton.loadButtons(div);
        return div;
    };

    equipmentTable.load([
        'property_number',
        'equipment_type',
        'description',
        'status',
        'division',
        'remarks',
    ]);
    // generateWordBrowser(data, '../../RFQ.docx', (blob) => {
    //       rfqClass.updateRFQ(data, blob, (e) => {
    //     });
    // });
    $('#create_iepmc_btn').on('click', function() {
        $('#maintenanceModal').modal('show');
    })

    $('.submit_iepmc_btn').on('click', function() {
        $('#maintenance_form').trigger('submit');
    })
    
    $('.submit_update_iepmc_btn').on('click', function() {
        $('#update-maintenance_form').trigger('submit');
    })
});