import { usersClass } from "../User/User";
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
    
    PRValidator.CreatePRValidation((e) => {
        e.preventDefault();
        PRClass.updatePR(PRValidator.serializeArrayToJson('.updatepr'), PRValidator.items, PRValidator.members, (e) => {
            window.location.reload(true);
        });
    }, 'updatepr');

    PRClass.getPrItems(localStorage.getItem('pr_id'), (data) => {
        PRValidator.items = data.items;
        data.pr.members.forEach(member => {
            PRValidator.members.push({ user_id: member.user_id, role: member.role });
        });
        console.log(data.pr.members);
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

    });
});