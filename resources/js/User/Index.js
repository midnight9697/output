import {  usersClass } from "./User";
import {  UserMod } from "./action";
import { GValidator } from "./Validation";

document.addEventListener('DOMContentLoaded', () => {
  // Load all users for validation
  usersClass.getAllUsers((users) => {
    GValidator.StoreUserValidation(users, UserMod.createUser);
    // GValidator.Store
  });
  // Load paginated users
  usersClass.getByPage((paging) => {
    UserMod.fetchUsersTable(paging)
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