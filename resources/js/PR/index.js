// import { CustomTable } from "../custom_table";
import Custom_table from "../table/custom_table";
import { PRClass } from "./purchase_request";
import { PRValidator } from "./validation";


document.addEventListener('DOMContentLoaded', () => {
    const PRtable = new Custom_table('#prTable', false, true, true, false, './api/pr/page');

    PRtable.custom_buttons = (data) => {
        let edit_button = document.createElement('button');
        edit_button.innerText = (localStorage.getItem('user') == data.created_by.user_id?"EDIT":'REVIEW');
        edit_button.className = "ui very tiny "+(localStorage.getItem('user') == data.created_by.user_id?"green":"grey")+" button";
        edit_button.onclick = (e) => {
            data.element = e;
            window.location = window.location+'/'+data.id+'/edit';
        };
        let div = document.createElement('div');
        
        div.appendChild(edit_button);
        return div;
    }
    
    PRtable.load([
        'entity_name',
        'fund_cluster',
        'office',
        'pr_number',
        // 'created_by.lastname',
        'created_at',
        'responsibility_center_code',
        'purpose',
        'members.length',
    ]);
});