import Custom_table from "../table/custom_table";
import { PRClass } from "./purchase_request";

document.addEventListener('DOMContentLoaded', () => {
    $('.menu .item').tab();
    CTable(new Custom_table('#inbox', false, true, false, false, './api/pr/page'), 'inbox');
    CTable(new Custom_table('#outbox', false, true, false, false, './api/pr/page'), 'outbox');
    CTable(new Custom_table('#personal', false, true, false, false, './api/pr/page'), 'track');
});

function CTable(CTBL, tab = 'inbox') {
    
    switch (tab) {
        case 'inbox':
            CTBL.dataSrc = (json) => {
                let transactions = json.data.filter(el => el.last_transaction);
                return transactions.filter(el => el.last_transaction.last_recepient.receiver_id == localStorage.getItem('user') && el.approval == 1);
            }
            break;
        case 'outbox':
            CTBL.dataSrc = (json) => {
                return json.data.filter(el => el.approval == 1 && el.last_transaction.last_recepient.receiver_id != localStorage.getItem('user'));
            }
            break;
    
        default:
            CTBL.dataSrc = (json) => {
                return json.data.filter(el => el.members.filter(member => member.user_id ==localStorage.getItem('user')).length > 0);
            }
            break;
    }

    CTBL.custom_buttons = (data) => {
        let button = document.createElement('button');
        let title = (localStorage.getItem('user') == data.created_by.user_id?"EDIT":'REVIEW');
        let url = window.location+'/'+data.id+'/edit';
        let ui = "ui very tiny "+(localStorage.getItem('user') == data.created_by.user_id?"green":"grey")+" button";
        if (data.approval == 1) {
            title = "TRACK";
            url = window.location+'/'+data.id+'/track';
            ui = "ui very tiny primary button";
            if (tab == 'inbox') {
                if ((data.last_transaction.last_recepient.receiver_id == localStorage.getItem('user'))) {
                    title = "RECEIVE";
                    if (data.last_transaction.last_recepient.received == 1) {
                        title = 'PROCESS';
                        ui = "ui very tiny green button";
                        url = window.location+'/process/'+data.id;
                    }
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
                        CTBL.table.ajax.reload();
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

    CTBL.target_date = 9;
    // CTBL.targets = [4, 5];
    CTBL.load([
        'entity_name',
        'fund_cluster',
        'office',
        'pr_number',
        'responsibility_center_code',
        'purpose',
        'created_by_c_o_n_c_a_tfirstname_lastname_as_fullname',
        'members.length',
        'created_at',
        'last_transaction_created_at_as_latest_date',
    ]);
}