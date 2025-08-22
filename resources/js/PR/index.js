import Custom_table from "../table/custom_table";
import { PRClass } from "./purchase_request";

document.addEventListener('DOMContentLoaded', () => {
    const PRtable = new Custom_table('#prTable', false, true, true, false, './api/pr/page');

    PRtable.custom_buttons = (data) => {
        let button = document.createElement('button');
        let title = (localStorage.getItem('user') == data.created_by.user_id?"EDIT":'REVIEW');
        let url = window.location+'/'+data.id+'/edit';
        let ui = "ui very tiny "+(localStorage.getItem('user') == data.created_by.user_id?"green":"grey")+" button";
        if (data.approval == 1) {
            title = "TRACK";
            url = window.location+'/'+data.id+'/track';
            ui = "ui very tiny primary button";
            if (data.last_transaction.last_recepient.receiver_id == localStorage.getItem('user')) {
                title = "RECEIVE";
                if (data.last_transaction.last_recepient.received == 1) {
                    title = 'PROCESS';
                    ui = "ui very tiny green button";
                    url = window.location+'/process/'+data.id;
                }
            }
        }
        button.innerText = title;
        button.className = ui;
        button.onclick = (e) => {
            data.element = e;
            if (data.approval == 1) {
                if (data.last_transaction.last_recepient.receiver_id == localStorage.getItem('user') && data.last_transaction.last_recepient.received == 0) {
                    button.className = "ui very tiny primary loading button"
                    button.innerText = "...";
                    button.onclick = () => {};
                    PRClass.receivePR({
                        pr_id: data.id,
                    }, () => {
                        PRtable.table.ajax.reload();
                    });
                }
                else {
                    window.location = url;
                }
            }
            else {
                window.location = url;
            }
        };
        let div = document.createElement('div');
        
        div.appendChild(button);
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