import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";

var active_table;
var items_table;
document.addEventListener('DOMContentLoaded', () => {
    active_table = new Custom_table('#abstract-table', false, true, false, false, './api/abstract/page')
    items_table = document.getElementById('#abstract-items-body')

    $('#create_abstract_vbtn').on('click', () => {
        $('#uploadABSTRACTModal').modal('show');
    });

    $('.submit_upload_button').on('click', () => {
        console.log('shit');
    })

    items_table.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.loadButtons(div);
        return div;
    };

    active_table.load([
        'title',
        'purpose',
        'created_at',
    ]);
});

function projectsTable(projects) {
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