import { MessageMod } from "../app";
import { RFQValidator } from "../rfq/validation";
import { TBLButton } from "../table/buttons";
import { SupplementalPojectControl, SupplementalValidator } from "./validation";

let formClass = ".formCreateSupplementalSpec";
document.addEventListener('DOMContentLoaded', () => {

    $('.submit_supplemental_form_button').on('click', () => {
        $('.formCreateSupplemental').trigger('submit');
    })
    $('.add_item_button').on('click', () => {
        $('#modalCreateSupplementalSpec').modal('show');
    });

    $('.add_rfq_item_button').on('click', () => {
        $(formClass).trigger('submit');
    });

    SupplementalValidator.CreateSupplementalValidation((e) => {
        e.preventDefault();
        MessageMod.success("Supplemental successfully created.");
    });

    SupplementalPojectControl.CreateSupplementalProjectValidation((e) => {
        e.preventDefault();
        let formArray = RFQValidator.serializeArrayToJson(formClass);
        SupplementalValidator.items.push(formArray);
        MessageMod.success("Supplemental Project successfully added.");
        specsTable(SupplementalValidator.items);
    });
    
    specsTable(SupplementalValidator.items);
});

function specsTable(projects) {
    console.log(projects);
    let projectrow = "";
    
    projects.forEach(proj => {
        let parent = document.createElement('div');
        TBLButton.data = proj;
        TBLButton.deleteAction = true;
        TBLButton.deleteClassName = "removeItem";
        TBLButton.loadButtons(parent);
        projectrow += `
            <tr>
                <td>${proj.code}</td>
                <td>${proj.procurement_project}</td>
                <td>${proj.end_user}</td>
                <td>${(proj.early_procurement==1?"YES":"NO")}</td>
                <td>${proj.mode_of_procurement}</td>
                <td>${proj.advertisement}</td>
                <td>${proj.submission}</td>
                <td>${proj.notice_of_awards}</td>
                <td>${proj.contract_signing}</td>
                <td>${proj.total}</td>
                <td>${proj.mooe}</td>
                <td>${proj.co}</td>
            </tr>
        `;
    });

    if (projects.length == 0) {
        projectrow += `
            <tr>
                <td colspan="12">No Record Found</td>
            </tr>
        `;
    }

    document.getElementById('projects_table_body').innerHTML = projectrow;
    $('.removeItem').on('click', (e) => {
        console.log(e.target.dataset.id);
        SupplementalValidator.items = SupplementalValidator.items.filter(el => el.id != e.target.dataset.id);
        specsTable(SupplementalValidator.items);
    });
    TBLButton.relinitialize();
}