import { PRClass } from "../PR/purchase_request";
import { UserMod, usersClass } from "./User";
import { GValidator } from "./Validation";

document.addEventListener('DOMContentLoaded', () => {
  // Load all users for validation
  usersClass.getAllUsers((users) => {
    GValidator.StoreUserValidation(users);
  });
  // Load paginated users
  usersClass.getByPage((paging) => {
    UserMod.fetchUsersTable(paging)
  });
  $('#create_user_vbtn').on('click', UserMod.createUserAction)
  $('#division').on('change', UserMod.sectionGetAction)
  $('#formCreateUser').on('submit', UserMod.createUser)
  $('#createUserFinalize').on('click', () =>  { $('#formCreateUser').trigger('submit') });
  $('#show_password').on('change', () => {
    document.getElementById('password').type = ($('#show_password').is(':checked')?'text':'password');
    document.getElementById('password_confirmation').type = ($('#show_password').is(':checked')?'text':'password');
  });
})
