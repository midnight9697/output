import { MessageMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { PRClass } from "./purchase_request";
import { PRValidator } from "./validation";
let current_update_pr = [];
document.addEventListener('DOMContentLoaded', () => {
    $('.menu .item').tab();
    CTable(new Custom_table('#inbox', false, true, false, false, './api/pr/inbox_pr'), 'inbox');
    CTable(new Custom_table('#outbox', false, true, false, false, './api/pr/outbox_pr'), 'outbox');
    CTable(new Custom_table('#personal', false, true, false, false, './api/pr/track_pr'), 'track');
    CTable(new Custom_table('#close', false, true, false, false, './api/pr/closed_pr'), 'close');
    $('.submit_monitoring_button').on('click', () => {
        $('#formCreatePRMonitorItem').trigger('submit');
    })
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
        if (data.last_transaction.action == 12) {
            let div = document.createElement('div');
            TBLButton.data = data;
            TBLButton.viewName = "QUOTATION";
            TBLButton.udpateName = "PR MONITORING";
            TBLButton.viewAction = () => {
                window.location = '/pr/rfq/create/'+data.id;
            }
            TBLButton.updateAction = () => {
                current_update_pr = data;
                console.log(data);
                $('#formCreatePRMonitorItem')[0].reset();      
                $('.ui.dropdown.suppliers').dropdown('clear');
                document.getElementById('monitoring_pr_number').innerHTML = data.pr_number;
                const dropdown = $('.ui.dropdown.suppliers').dropdown();

                if (current_update_pr.monitoring) {
                    let monitor = current_update_pr.monitoring;
                    document.getElementById('canvass_date').value = (monitor.canvass?formatYMD(new Date(monitor.canvass)):"");
                    document.getElementById('abstract_date').value = (monitor.abstract?formatYMD(new Date(monitor.abstract)):"");
                    document.getElementById('opening_date').value = (monitor.opening?formatYMD(new Date(monitor.opening)):"");
                    document.getElementById('date_of_award').value = (monitor.award_date?formatYMD(new Date(monitor.award_date)):"");
                    document.getElementById('date_of_po').value = (monitor.order_date?formatYMD(new Date(monitor.order_date)):"");
                    // Dynamically set selected values (must match data-value)
                    const decoded = monitor.winner
                    .replace(/&quot;/g, '"')   // replace &quot; with"
                    .replace(/&amp;/g, '&');
                    dropdown.dropdown('set selected',JSON.parse(decoded));
                }
                PRValidator.CreatePRMonitorValidation((e) => {
                    e.preventDefault();
                    let bind_monitor_data = PRValidator.serializeArrayToJson('#formCreatePRMonitorItem');
                    bind_monitor_data['winners'] = dropdown.dropdown('get value');
                    bind_monitor_data['pr_id'] = current_update_pr.id;
                    console.log('binder', bind_monitor_data);
                    PRClass.createUpdatePRMonitor(bind_monitor_data, (result) => {
                        console.log('Result', result);
                        MessageMod.success('SAVED CHANGES', () => {
                            $('#updateMonitorModal').modal('hide');
                        });
                    })
                });
                $('#updateMonitorModal').modal('show');
            }
            TBLButton.loadButtons(div);
            return div;
        }
        let button = document.createElement('button');
        console.log('CREATED BY', data.approval);
        let title = (localStorage.getItem('user') == data.created_by.user_id?"EDIT":'REVIEW');
        let url = window.location+'/'+data.id+'/edit';
        let ui = "ui very tiny "+(localStorage.getItem('user') == data.created_by.user_id?"green":"grey")+" button";
        if (data.approval == 1) {
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

function formatYMD(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
    const day = String(date.getDate()).padStart(2, '0');
  
    return `${year}-${month}-${day}`;
  }