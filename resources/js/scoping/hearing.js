import { PRValidator } from "../PR/validation";
import { confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { hearingController } from "./scoping";
import { updatePHForm } from "./update";
import { PScValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {
    const phTable = new Custom_table('#hearing-table', false, true, false, true, './ph-data');
    const update_field =  document.getElementById('update-ph-form-field');
    let current_id;
    PScValidator.CreatePHValidation((e) => {
        e.preventDefault();
        let data = {
            'tentative_date_and_time': PRValidator.serializeArrayToJson('.insert-ph-form').tentative_date_and_time,
            'public_hearing_location': PRValidator.serializeArrayToJson('.insert-ph-form').public_hearing_location,
            'project_name': PRValidator.serializeArrayToJson('.insert-ph-form').project_name,
            'project_proponent': PRValidator.serializeArrayToJson('.insert-ph-form').project_proponent,
            'project_location': PRValidator.serializeArrayToJson('.insert-ph-form').project_location,
            'project_description': PRValidator.serializeArrayToJson('.insert-ph-form').project_description,
        }
        hearingController.insert(data, ()=> {
            $('#insertPHModal').modal('hide');
            phTable.table.ajax.reload();
        });
    }, 'insert-ph-form');

    PScValidator.UpdatePHValidation((e) => {
        e.preventDefault();
        let data = {
            'id': current_id,
            'tentative_date_and_time': PRValidator.serializeArrayToJson('.update-ph-form').tentative_date_and_time,
            'public_hearing_location': PRValidator.serializeArrayToJson('.update-ph-form').public_hearing_location,
            'project_name': PRValidator.serializeArrayToJson('.update-ph-form').project_name,
            'project_proponent': PRValidator.serializeArrayToJson('.update-ph-form').project_proponent,
            'project_location': PRValidator.serializeArrayToJson('.update-ph-form').project_location,
            'project_description': PRValidator.serializeArrayToJson('.update-ph-form').project_description,
        }

        hearingController.update(data, ()=> {
            $('#updatePHModal').modal('hide');
            phTable.table.ajax.reload();
        });
    }, 'update-ph-form');

    // Page Buttons

    $('#insertPHBtn').on('click', () => {
        confirmMod.load(function()  {
            $('.ui.form.insert-ph-form').removeClass('error');
            $('.ui.form.insert-ph-form').form('reset');
            $('.ui.form.insert-ph-form').form('clear');
            $('#insertPHModal').modal('show');
        }, "Do you want to clear the form ?", () => {
            $('#insertPHModal').modal('show');
        });
    })

    $('#insert-ph-submit-btn').on('click', () => {
        $('.insert-ph-form').trigger('submit');
    });

    $('#update-ph-submit-btn').on('click', () => {
        $('.update-ph-form').trigger('submit');
    });

    phTable.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        TBLButton.viewName = 'View';
        TBLButton.viewAction = () => {
            window.open(data.project_description);
        }

        TBLButton.updateAction = () => {
            current_id = data.id;
            update_field.innerHTML = updatePHForm(data);
            $('#updatePHModal').modal('show');
            // window.location = 'iepmc/stream/2025/'+data.id;
        }

        TBLButton.deleteAction = () => {
            confirmMod.load(() => {
                hearingController.remove(data.id, ()=> {
                    phTable.table.ajax.reload();
                });
            }, "Remove this public scoping schedule posting ?")
        }

        TBLButton.loadButtons(div);
        return div;
    }

    phTable.load([
        'tentative_date_and_time',
        'public_hearing_location',
        'project_name',
        'project_proponent',
        'project_location',
    ]);
});