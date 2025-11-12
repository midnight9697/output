import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { PRClass } from "./purchase_request";

document.addEventListener('DOMContentLoaded', () => {
    $('.menu .item').tab();
    CTable(new Custom_table('#inbox', false, true, false, false, './api/pr/inbox_pr'), 'inbox');
    CTable(new Custom_table('#outbox', false, true, false, false, './api/pr/outbox_pr'), 'outbox');
    CTable(new Custom_table('#personal', false, true, false, false, './api/pr/track_pr'), 'track');
    CTable(new Custom_table('#close', false, true, false, false, './api/pr/closed_pr'), 'close');
});

function CTable(CTBL, tab = 'inbox') {
    
    switch (tab) {
        case 'inbox':
            PRClass.inbox_pr = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
            }
            break;
        case 'outbox':
            PRClass.outbox_pr = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
            }
            break;
        case 'close':
            PRClass.closed_pr = (res) => {
                CTBL.dataSrc = (json) => {
                    return res
                }
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
        console.log('CREATED BY', data.approval);
        let title = (localStorage.getItem('user') == data.created_by.user_id?"EDIT":'REVIEW');
        let url = window.location+'/'+data.id+'/edit';
        let ui = "ui very tiny "+(localStorage.getItem('user') == data.created_by.user_id?"green":"grey")+" button";
        if (data.approval == 1) {
            console.log('Shit', data);
            title = data.last_transaction.action == 12?"QUOTATION":"TRACK";
            url = data.last_transaction.action == 12?'/pr/rfq/create/'+data.id:window.location+'/'+data.id+'/track';
            ui = "ui very tiny primary button";
            if (tab == 'inbox') {
                if (data.last_transaction.last_recepient) {
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
        }
        button.innerText = title;
        button.className = ui;
        console.log(url);
        
        button.onclick = (e) => {
            data.element = e;
            if (data.approval == 1) {
                if (data.last_transaction.last_recepient) {
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
        'pr_number',
        'entity_name',
        'fund_cluster',
        'office',
        'responsibility_center_code',
        'purpose',
        'created_by_c_o_n_c_a_tfirstname_lastname_as_fullname',
        // 'members.length',
        'created_at',
        'last_transaction_created_at_as_latest_date',
    ]);
}