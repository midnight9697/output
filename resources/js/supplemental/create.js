let formClass = "formCreateSupplementalSpec";
document.addEventListener('DOMContentLoaded', () => {
    $('.add_item_button').on('click', () => {
        $('#modalCreateSupplementalSpec').modal('show');
    });

    $('#add_rfq_item_button').on('click', () => {
        $('.'+formClass).trigger('submit');
    });

    $('.'+formClass).on('submit', () => {
        alert('Shit');
    });
});

function specsTable(projects) {
    let projectrow = "";
    
    projects.forEach(proj => {
        let parent = document.createElement('div');
        TBLButton.data = proj;
        TBLButton.deleteAction = true;
        TBLButton.deleteClassName = "removeItem";
        TBLButton.loadButtons(parent);
        projectrow += `
            <tr>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
                <td>${proj.project_procurement}</td>
            </tr>
        `;
    });

    if (projects.length == 0) {
        projectrow += `
            <tr>
                <td colspan="7">No Record Found</td>
            </tr>
        `;
    }

    document.getElementById('projects_table_body').innerHTML = specsrow;
    $('.removeItem').on('click', (e) => {
        console.log(e.target.dataset.id);
        RFQValidator.items = RFQValidator.items.filter(el => el.id != e.target.dataset.id);
        specsTable(RFQValidator.items);
    });
    TBLButton.relinitialize();
}