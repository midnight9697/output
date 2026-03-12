import { confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { iepmcValidator } from "./validation";
import { generateWordBrowser } from "../generate";
import { PRValidator } from "../PR/validation";
import { iepmcController } from "./iepms";
import { updateIEPMCForm } from "./update";

let iepmcTable;
document.addEventListener('DOMContentLoaded', () => {
    iepmcTable = new Custom_table('#iepmc-table', false, true, false, true, './api/iepmc/page')
    
    iepmcValidator.CreateIEPMCValidation((e) => {
        e.preventDefault();
        let data = PRValidator.serializeArrayToJson('.maintenance_form')
        generateWordBrowser(data, '/IEPMC.docx', (blob) => {
            console.clear();  
            iepmcController.create(data, blob, () => {
                console.log('Success');
            })
        });
        alert('Submitted');
    });

    iepmcTable.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        TBLButton.deleteAction = (e) => {
          confirmMod.load(() => {
            let iepmc_id = e.target.dataset.id;
            iepmcTable.table.ajax.reload();
          }, "Do you want to delete this file ?");
        }

        TBLButton.updateAction = (e) => {
            iepmcController.fetch_item(data.id, (item) => {
                document.getElementById('update-maintenance_form').innerHTML = updateIEPMCForm(item);
                $('#update-maintenanceModal').modal('show');
            })
        }
        TBLButton.loadButtons(div);
        return div;
    };

    iepmcTable.load([
        'document_number',
        'property_number',
        'issued_to',
        'brand_model',
        'mac_address',
        'inspected_by',
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
});