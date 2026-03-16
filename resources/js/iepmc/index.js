import { confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { iepmcValidator } from "./validation";
import { generateWordBrowser } from "../generate";
import { PRValidator } from "../PR/validation";
import { iepmcController } from "./iepms";
import { updateIEPMCForm } from "./update";

let iepmcTable;
let current_iepmc = null;
document.addEventListener('DOMContentLoaded', () => {
    iepmcTable = new Custom_table('#iepmc-table', false, true, false, true, './api/iepmc/page')
    
    iepmcValidator.CreateIEPMCValidation((e) => {
        e.preventDefault();
        let data = PRValidator.serializeArrayToJson('.maintenance_form');
        let values = [];

        for (let i = 1; i <= 37; i++) {
            let cb = $('input[name="cb' + i + '"]');
        
            if (cb.is(':checked')) {
                values.push(cb.val());
            } else {
                values.push(0); // or false if unchecked
            }
        }

        let cb = $('input[name="cb3A"]');
        if (cb.is(':checked')) {
            data.cb3a = [cb.val()];
        } else {
            data.cb3a = 0; // or false if unchecked
        }
        data.cbs = values;

        generateWordBrowser(data, './iepmc/stream-template', (blob) => {
            console.clear();
            console.log('Serialize', data);
            // iepmcController.create(data, blob, () => {
            //     iepmcTable.table.ajax.reload();
            //     $('#maintenanceModal').modal('hide');
            // })
        });
        alert('Submitted');
    });

    iepmcValidator.UpdateIEPMCValidation((e) => {
        e.preventDefault();
        let data = PRValidator.serializeArrayToJson('#update-maintenance_form');
        generateWordBrowser(data, './iepmc/stream-template', (blob) => {
            data['id'] = current_iepmc.id;
            iepmcController.update(data, blob, () => {
                iepmcTable.table.ajax.reload();
                $('#update-maintenanceModal').modal('hide');
            });
        });
    });

    iepmcTable.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        TBLButton.viewName = 'Download';
        TBLButton.viewAction = () => {
            window.location = 'iepmc/stream/2025/'+data.id;
        }

        TBLButton.deleteAction = (e) => {
          confirmMod.load(() => {
            let iepmc_id = e.target.dataset.id;
            iepmcTable.table.ajax.reload();
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
    
    $('.submit_update_iepmc_btn').on('click', function() {
        $('#update-maintenance_form').trigger('submit');
    })
});