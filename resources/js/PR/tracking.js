import { membersTable } from "./create";
import { PRClass } from "./purchase_request";
import { PRValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {

    $('.ui.accordion').accordion();

    $('#modalRoutePR').on('submit', (e) => {
        e.preventDefault();
        let data = PRValidator.serializeArrayToJson('.routingForm');
        data['assigned_to'] = PRValidator.assigned;
        PRClass.routePR(data, (respsons) => {
          window.location = '../'+localStorage.getItem('pr_id')+'/track';
        })
      });

    PRClass.getPrItems(localStorage.getItem('pr_id'), dataFetcher);
});

function dataFetcher(data) {
    PRValidator.transactions = data.transactions;
    PRValidator.members = data.pr.members;
    PRValidator.pr = data.pr;
    PRValidator.memebr_ids = [];

    data.pr.members.forEach(member => {
        PRValidator.memebr_ids.push(member.user_id);
    });
    
    if (localStorage.getItem('amember') == 1) {
        membersTable(PRValidator.members);
    }
    transactionTable()
}

function transactionTable() {
    let parentElement = $('.transaction_preview');
    let ht = "";

    PRValidator.transactions.slice(0, 20).forEach((transaction, index) => {
        let receiver = "";
        let member_count = 0;
        transaction.recepients.forEach(recepient => {
            if (PRValidator.memebr_ids.includes(recepient.receiver_id)) {
                member_count += 1;
            }
        });
        ht += `
        <div class="item">
        <div class="right floated content">
            <small>Assigned: ${((member_count == PRValidator.members.length)?"Members":transaction.recepient.profile.firstname+" "+transaction.recepient.profile.lastname)}</small>
        </div>
          <i class="location arrow icon"></i>
          <div class="content">
            <a class="header">${(transaction.sender_id==localStorage.getItem('user')?"You":transaction.sender.firstname+" "+transaction.sender.lastname)}</a>
            ${(transaction.action == 1 && transaction.body != ""?"":`<small style="color:green">(${transaction.act.synonyms})${transaction.recepient.received == 1?" | Received":""}</small>`)}
            
            <div class="description"><b>${transaction.created_for}</b> | ${transaction.body}</div>
          </div>
        </div>
        `;
    });
    parentElement.html(ht);
}