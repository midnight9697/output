import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";

var active_table;
var items_table;
document.addEventListener('DOMContentLoaded', () => {
    active_table = new Custom_table('#abstract-table', false, true, false, false, './api/abstract/page')
    items_table = document.getElementById('#abstract-items-body')

    $('#create_abstract_vbtn').on('click', () => {
        window.location = './abstract/create';
    });

    active_table.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.udpateName = "UPDATE";
        TBLButton.loadCustomBtns(div);
        
        TBLButton.createCustomButton(div, 'UPDATE', 'updateAbstract', (data) => {
            window.location = "./abstract/process/"+data.rfq_id;
        }, data);

        TBLButton.createCustomButton(div, 'PREVIEW', 'previewAbstract', () => {
            window.open("/abstract/preview/"+data.id, '__blank')
        })
        return div;
    }

    active_table.load([
        'purpose',
        'created_at',
    ]);
});
