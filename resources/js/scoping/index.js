import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";

document.addEventListener('DOMContentLoaded', () => {
    const iepmcTable = new Custom_table('#iepmc-table', false, true, false, true, './ps-data');

    iepmcTable.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.data = data;
        TBLButton.viewName = 'Click here';
        TBLButton.viewAction = () => {
            // window.location = 'iepmc/stream/2025/'+data.id;
            window.open(data.project_description);
        }
        TBLButton.loadButtons(div);
        return div;
    }

    iepmcTable.load([
        'tentative_date_and_time',
        'public_scoping_location',
        'project_name',
        'project_proponent',
        'project_location',
    ]);
});