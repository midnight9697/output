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
