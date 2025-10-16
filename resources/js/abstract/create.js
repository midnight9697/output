
document.addEventListener('DOMContentLoaded', () => {
    
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