import {  usersClass } from "./User";
import {  UserMod } from "./action";
import { GValidator } from "./Validation";
import { pageLoader } from "../app";
document.addEventListener('DOMContentLoaded', () => {
  // Load all users for validation
  const tableLoad = new pageLoader();
  usersClass.getAllUsers((users) => {
    GValidator.StoreUserValidation(users, UserMod.createUser);
  });

  // Load paginated users
  usersClass.getByPage((paging) => {
      UserMod.fetchUsersTable(paging);
      tableLoad.destroy(document.getElementById('users_loader'));
  });
  $('#create_user_vbtn').on('click', UserMod.createUserAction)
  
  $('#division').on('change', UserMod.sectionGetAction)

  $('#show_password').on('change', () => {
    document.getElementById('password').type = ($('#show_password').is(':checked')?'text':'password');
    document.getElementById('password_confirmation').type = ($('#show_password').is(':checked')?'text':'password');
  });
  
  $('.search_user').on('keyup', (e) => {
    usersClass.searchQuery((data) => {
    UserMod.fetchUsersTable(data);
    }, e.target.value);
  });
});