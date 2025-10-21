import { TBLButton } from "../table/buttons";
import { rfqClass } from "../rfq/rfq";

document.addEventListener('DOMContentLoaded', () => {
    $('.ui.dropdown').dropdown({
        onChange: function(value, text, $choice) {
            rfqClass.fetch_rfq({
                ids: value
            }, (response) => {
                console.log(response);
                projectsTable(response.data);
            })
        }
    });
    // projectsTable([]);
});

function projectsTable(projects) {
    let projectrow = "";
    for (let i = 0; i < projects.length; i++) {
        const proj = projects[i];
        console.log('Shit', proj);
        let parent = document.createElement('div');
        TBLButton.data = proj;
        TBLButton.updateAction = true;
        TBLButton.updateClassName = "updateItem";
        TBLButton.loadButtons(parent);
        projectrow += `
            <tr>
                <td>${(i+1)}</td>
                <td>${proj.quantity_unit}</td>
                <td></td>
                <td>${proj.specification}</td>
                <td>${parent.innerHTML}</td>
            </tr>
        `;
    }
    
    if (projects.length == 0) {
        projectrow += `
            <tr>
                <td colspan="12">No Record Found</td>
            </tr>
        `;
    }

    document.getElementById('abstract-items-body').innerHTML = projectrow;
    $('.updateItem').on('click', (e) => {
        console.log(e.target.dataset.id);
        $('#addBiddderModal').modal('show');
    });
    TBLButton.relinitialize();
}