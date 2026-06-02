import { useState } from "react";
import { PRValidator } from "../PR/validation";
import { confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { scopingController } from "./scoping";
import { updateForm } from "./update";
import { PScValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {
    const psTable = new Custom_table('#iepmc-table', false, true, false, true, './ps-data');
    const update_field =  document.getElementById('update-form-field');
    let current_id = 0;
    PScValidator.CreatePSValidation((e) => {
        e.preventDefault();
        let data = {
            'tentative_date_and_time': PRValidator.serializeArrayToJson('.insert-form').tentative_date_and_time,
            'public_scoping_location': PRValidator.serializeArrayToJson('.insert-form').public_scoping_location,
            'project_name': PRValidator.serializeArrayToJson('.insert-form').project_name,
            'project_proponent': PRValidator.serializeArrayToJson('.insert-form').project_proponent,
            'project_location': PRValidator.serializeArrayToJson('.insert-form').project_location,
            'project_description': PRValidator.serializeArrayToJson('.insert-form').project_description,
        }
        scopingController.insert(data, ()=> {
            $('#insertModal').modal('hide');
            psTable.table.ajax.reload();
        });
    }, 'insert-form');

    PScValidator.UpdatePSValidation((e) => {
        e.preventDefault();
        let data = {
            'id': current_id,
            'tentative_date_and_time': PRValidator.serializeArrayToJson('.update-form').tentative_date_and_time,
            'public_scoping_location': PRValidator.serializeArrayToJson('.update-form').public_scoping_location,
            'project_name': PRValidator.serializeArrayToJson('.update-form').project_name,
            'project_proponent': PRValidator.serializeArrayToJson('.update-form').project_proponent,
            'project_location': PRValidator.serializeArrayToJson('.update-form').project_location,
            'project_description': PRValidator.serializeArrayToJson('.update-form').project_description,
        }

        scopingController.update(data, ()=> {
            $('#updateModal').modal('hide');
            psTable.table.ajax.reload();
        });
    }, 'update-form');
    
    psTable.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        TBLButton.viewName = 'View';
        TBLButton.viewAction = () => {
            window.open(data.project_description);
        }

        TBLButton.updateAction = () => {
            current_id = data.id;
            update_field.innerHTML = updateForm(data);
            $('#updateModal').modal('show');
            // window.location = 'iepmc/stream/2025/'+data.id;
        }

        TBLButton.deleteAction = () => {
            confirmMod.load(() => {
                scopingController.remove(data.id, ()=> {
                    psTable.table.ajax.reload();
                });
            }, "Remove this public scoping schedule posting ?")
        }

        TBLButton.loadButtons(div);
        return div;
    }

    $('#insert-submit-btn').on('click', () => {
        $('.insert-form').trigger('submit');
    });

    $('#update-submit-btn').on('click', () => {
        $('.update-form').trigger('submit');
    });

    $('#insertPSBtn').on('click', () => {
        confirmMod.load(function()  {
            $('.ui.form.insert-form').removeClass('error');
            $('.ui.form.insert-form').form('reset');
            $('.ui.form.insert-form').form('clear');
            $('#insertModal').modal('show');
        }, "Do you want to clear the form ?", () => {
            $('#insertModal').modal('show');
        });
    })

    psTable.load([
        'tentative_date_and_time',
        'public_scoping_location',
        'project_name',
        'project_proponent',
        'project_location',
    ]);
});