import { usersClass } from "../User/User";
import { MessageMod, confirmMod } from "../app";
import { itemsTable, membersTable } from "./create";
import { PRClass } from "./purchase_request";
import { PRValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {

    $('.add_member_btn').on('click', function() {
        $('#modalAddMember').modal('show');
    });

    $('.submit_user_to_list').on('click', () => {
        $('.ui.search.search-people').search('query', '');
        $('#modalAddMember').modal('hide');
        PRValidator.members.push({
            user_id: PRValidator.selected.user_id,
            role: $('.member-role').val()
        });
    });

    $('.commentFormBtn').on('click', () =>{
        let data = {};
        data['action'] = document.getElementById('alternative').value;
        data['body'] = document.getElementById('long-message').value;
        confirmMod.load((e) => {
            PRClass.commentPR(data, (e) => {
            document.getElementById('alternative').value = 1;
            document.getElementById('long-message').value = "";
            PRClass.getPrItems(localStorage.getItem('pr_id'), dataFetcher);
            // MessageMod.success("Review Posted");
            });
        }, "Do you want to submit this review ?");
        
    });
    
    PRValidator.CreatePRValidation((e) => {
        e.preventDefault();
        PRClass.updatePR(PRValidator.serializeArrayToJson('.updatepr'), PRValidator.items, PRValidator.members, (e) => {
            window.location.reload(true);
        });
    }, 'updatepr');
    
    PRClass.getPrItems(localStorage.getItem('pr_id'), dataFetcher);
});

function dataFetcher(data) {
    PRValidator.items = data.items;
    PRValidator.pr = data.pr;
    PRValidator.transactions = data.transactions;
    data.pr.members.forEach(member => {
        PRValidator.members.push({ user_id: member.user_id, role: member.role });
    });

    transactionTable()
    itemsTable();
    membersTable(data.pr.members);

    usersClass.getAllUsers((data) => {
        let seaching = $('.ui.search.search-people')
        .search({
          source: usersClass.profiles.filter(el => !(PRValidator.members.includes(el.user_id))),
          fields: {
            title   : 'name',
          },
          searchFields   : [
            'firstname',
            'middlename',
            'lastname',
            'email',
          ],
          onSelect: function(result, response) {
            PRValidator.selected = result;
          }
        });

    });

}

function transactionTable() {
    let parentElement = $('.transaction_preview');
    let ht = "";

    PRValidator.transactions.slice(0, 5).forEach((transaction, index) => {
        console.log(transaction.body);
        ht += `
        <div class="item">
          <i class="location arrow icon"></i>
          <div class="content">
            <a class="header">${(transaction.sender_id==localStorage.getItem('user')?"You":transaction.sender.firstname+" "+transaction.sender.lastname)}</a>
            ${(transaction.action == 1 && transaction.body != ""?"":`<small style="color:green">(${transaction.act.synonyms})</small>`)}
            
            <div class="description"><b>${transaction.created_at}</b> | ${transaction.body}</div>
          </div>
        </div>
        `;
    });

    parentElement.html(ht);
    
}