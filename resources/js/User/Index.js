import {  usersClass } from "./User";
import {  UserMod } from "./action";
import { GValidator } from "./Validation";
import Custom_table from "../table/custom_table";
import { pageLoader } from "../app";
import { TBLButton } from "../table/buttons";
document.addEventListener('DOMContentLoaded', () => {
  // Load all users for validation
//   const tableLoad = new pageLoader();
    const usersTableConroller = new Custom_table('#users_list_table', false, true, true, false, './api/users/getpage');
    usersTableConroller.topButton = true;
    usersTableConroller.topButtonText = '<i class="user icon"></i> REGISTER';
    usersTableConroller.topButtonAction = UserMod.createUserAction;

    usersTableConroller.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.loadCustomBtns(div);
        TBLButton.createCustomButton(div, 'UPDATE', 'update_btn', (e) => {
            let target = e.target.datasets;
            console.log(target);
            // window.location = './users/'+target.id+'/edit';
        }, data);

        return div;
    };
    
    usersTableConroller.load([
        'profile.firstname',
        'profile.lastname',
        'profile.middlename',
        'profile.division.division',
        'profile.section.section',
        'created_at'
    ]);
    
    usersClass.getAllUsers((users) => {
      GValidator.StoreUserValidation(users,((e) => {
        UserMod.createUser(e, usersTableConroller);
      }));
    });

    // Load paginated users
    // usersClass.getByPage((paging) => {
    //     UserMod.fetchUsersTable(paging);
    //     tableLoad.destroy(document.getElementById('users_loader'));
    // });
    // $('#create_user_vbtn').on('click', )

    $('#division').on('change', UserMod.sectionGetAction)

    $('#show_password').on('change', () => {
      document.getElementById('password').type = ($('#show_password').is(':checked')?'text':'password');
      document.getElementById('password_confirmation').type = ($('#show_password').is(':checked')?'text':'password');
    });

    // $('.search_user').on('keyup', (e) => {
    //   usersClass.searchQuery((data) => {
    //   UserMod.fetchUsersTable(data);
    //   }, e.target.value);
    // });
});