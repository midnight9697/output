import { confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { iepmcValidator } from "./validation";
import { generateWordBrowser } from "../generate";
import { PRValidator } from "../PR/validation";
import { iepmcController } from "./iepms";
import { updateIEPMCForm } from "./update";
import createIEPMCForm from "./create";

let iepmcTable;
let current_iepmc = null;
document.addEventListener('DOMContentLoaded', () => {
    iepmcTable = new Custom_table('#iepmc-table', false, true, false, true, './api/iepmc/page')
    // Loop Alphabet
    
    iepmcValidator.CreateIEPMCValidation((e) => {
        e.preventDefault();
        let data = PRValidator.serializeArrayToJson('.maintenance_form');
        
        for (let i = 'a'.charCodeAt(0); i <= 'z'.charCodeAt(0); i++) {
            let ltr = String.fromCharCode(i);
            let cb = $('input[name="' + ltr + '"]');
            
            if (ltr == "a" || ltr == "b") {
                for (let x = 1; x <= 9; x++) {
                    let cbab = $('input[name="' +ltr + x + '"]');
                    console.log(ltr + x );
                    if (cbab.is(':checked')) {
                        data[ltr + x ] = "✔";
                    } else {
                        data[ltr + x ] = "";
                    }
                }
            }

            if (cb.is(':checked')) {
                data[ltr] = "✔";
            } else {
                data[ltr] = "";
            }
        }
        
        generateWordBrowser(data, './iepmc/stream-template', (blob) => {
            // console.clear();
            console.log('Serialize', data);
            iepmcController.create(data, blob, () => {
                iepmcTable.table.ajax.reload();
                $('#maintenanceModal').modal('hide');
            })
        });
        // alert('Submitted');
    });

    iepmcValidator.UpdateIEPMCValidation((e) => {
        e.preventDefault();
        let data = PRValidator.serializeArrayToJson('.update-maintenance_form');
        
        for (let i = 'a'.charCodeAt(0); i <= 'z'.charCodeAt(0); i++) {
            let ltr = String.fromCharCode(i);
            let cb = $('input[name="' + ltr + '"]');
            
            if (ltr == "a" || ltr == "b") {
                for (let x = 1; x <= 9; x++) {
                    let cbab = $('input[name="' +ltr + x + '"]');
                    console.log(ltr + x );
                    if (cbab.is(':checked')) {
                        data[ltr + x ] = "✔";
                    } else {
                        data[ltr + x ] = "";
                    }
                }
            }

            if (cb.is(':checked')) {
                data[ltr] = "✔";
            } else {
                data[ltr] = "";
            }
        }
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
        TBLButton.viewName = 'View';
        TBLButton.viewAction = () => {
            // window.location = 'iepmc/stream/2025/'+data.id;
            window.open('iepmc/office/stream/2025/'+data.id);
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
                document.getElementById('maintenance_form').innerHTML = "";
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
        document.getElementById('maintenance_form').innerHTML = createIEPMCForm();
        $('#maintenanceModal').modal('show');
    })

    $('.submit_iepmc_btn').on('click', function() {
        $('#maintenance_form').trigger('submit');
    })
    
    $('.submit_update_iepmc_btn').on('click', function() {
        $('#update-maintenance_form').trigger('submit');
    })
});