import { PRClass } from "./purchase_request";
import { PRVItemalidator, PRValidator } from "./validation";


document.addEventListener('DOMContentLoaded', () => {

    $('.total_cost').on('input', () => {
        let total_cost_quantity = document.getElementsByClassName('total_cost');
        let total_cost = document.getElementById('total_cost');
        total_cost.value = total_cost_quantity[0].value * total_cost_quantity[1].value
    })

    $('.add_item_btn').on('click', () => {
        $('#modalCreaeItem').modal('show');
    })
    $('.submit_item_to_list').on('click', () => {
        $('#formCreatePRItem').trigger('submit');
    });

    PRValidator.CreatePRValidation((e) => {
        e.preventDefault();
        let serielize = PRValidator.serializeArrayToJson('.createpr');
        PRClass.creatPR(serielize, PRValidator.items, (e) => {
            window.location.reload(true);
        });
    });
    
    PRVItemalidator.CreatePRItemValidation((e) => {
        e.preventDefault();
        $('#modalCreaeItem').modal('hide');
        let total_cost_element = document.getElementById('total_cost');
        if (total_cost_element.hasAttribute('disabled')) {
            total_cost_element.removeAttribute('disabled');
        }
        PRValidator.items.push(PRValidator.serializeArrayToJson('.formCreatePRItem'));
        total_cost_element.disabled = true;
        itemsTable();
    });
    
    itemsTable();
});

export function itemsTable() {
    let tableParent = $('.table-pr-items');
    let ht = "";
    let itemRows = "";
    
    PRValidator.items.forEach(item => {
        itemRows += `
            <tr>
                <td>${item.property_number}</td>
                <td>${item.unit}</td>
                <td>${item.item_description}</td>
                <td>${item.quantity}</td>
                <td>${item.unit_cost}</td>
                <td>${item.total_cost}</td>
            </tr>
        `;
    });

    ht = `
        <table class="ui very basic collapsing celled table hidden" id="prTable" style="width:100%">
            <thead>
               <tr>
                    <th>Stock/Property No.</th>
                    <th>Unit</th>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Tota Cost</th>
               </tr>
            </thead>
            <tbody>
                ${(PRValidator.items.length == 0?`
                    <tr>
                        <td style="text-align:center" colspan="6">No Item Found</td>
                    </tr>
                `:itemRows)}
            </tbody>
        </table>
    `;

    tableParent.html(ht);
}

export function membersTable(members) {
    let tableParent = $('.members-form-section');
    let ht = "";
    let itemLists = "";

    members.forEach(member => {
        itemLists += `
            <div class="item">
              <div class="right floated content">
                ${member.created_by == localStorage.getItem('user')?"":`<div class="ui very tiny green button">EDIT</div>`}
              </div>
              <img class="ui avatar image" src="/files/images/user logo.png">
              <div class="content">
                <div class="header">${member.user.profile.lastname+" "+member.user.profile.firstname}</div>
                <small>${member.role}. ${(PRValidator.pr.created_by == member.user_id?"CREATOR":`ADDED BY: ${member.added_by.profile.firstname+" "+member.added_by.profile.lastname}`)}</small>
              </div>
            </div> 
        `;
    });

    ht = `
    <div class="ui middle aligned divided list">
        ${itemLists}    
    </div>
    `;

    tableParent.html(ht);
}