import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";

var active_table;
var items_table;
document.addEventListener('DOMContentLoaded', () => {
    active_table = new Custom_table('#abstract-table', false, true, false, false, './api/rfq/page')
    items_table = document.getElementById('#abstract-items-body')

    $('#create_abstract_vbtn').on('click', () => {
        window.location = './abstract/create';
    });

    active_table.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.updateAction = () => {
          window.location = "./abstract/process/"+data.id;        
        }
        
        TBLButton.loadButtons(div);
        return div;
    }

    active_table.load([
        'rfq_number',
        'project_purpose',
    ]);
});
