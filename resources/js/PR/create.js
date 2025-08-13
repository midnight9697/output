import { PRClass } from "./purchase_request";
import { PRVItemalidator, PRValidator } from "./validation";


document.addEventListener('DOMContentLoaded', () => {
    $('.add_item_btn').on('click', () => {
        $('#modalCreaeItem').modal('show');
    })
    $('.submit_item_to_list').on('click', () => {
        $('#formCreatePRItem').trigger('submit');
    });

    PRValidator.CreatePRValidation((e) => {
        e.preventDefault();
        PRClass.creatPR(PRValidator.serializeArrayToJson('.createpr'), PRValidator.items, (e) => {
            window.location.reload(true);
        });
    });
    
    PRVItemalidator.CreatePRItemValidation((e) => {
        e.preventDefault();
        $('#modalCreaeItem').modal('hide');
        PRValidator.items.push(PRValidator.serializeArrayToJson('.formCreatePRItem'));
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
                <div class="ui very tiny green button">EDIT</div>
              </div>
              <img class="ui avatar image" src="/files/images/user logo.png">
              <div class="content">
                ${member.user.profile.lastname+" "+member.user.profile.firstname}
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