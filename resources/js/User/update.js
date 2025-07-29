
import { BtnLoaderMod, MessageMod } from "../app";
import { usersClass } from "./User";
import { GValidator } from "./Validation";
import { UserMod } from "./action";

document.addEventListener('DOMContentLoaded', () => {
     // GValidator.form.form('is valid')
    usersClass.getAllUsers((users) => {
        GValidator.UpdateUserValidation(users);
    });

    $('#formUpdateUser').on('submit', (e) => {
        e.preventDefault();
        usersClass.getAllUsers((users) => {
            let user = {id: localStorage.getItem('user')};
            GValidator.UpdateUserValidation(users);
            if (GValidator.form.form('is valid')) {
                $('#formUpdateUser :input').prop('readonly', true);
                BtnLoaderMod.start(document.getElementById('save_changes_button'));
                $('#formUpdateUser').serializeArray().forEach(data => {
                  user[data.name] = data.value;
                });

                // 
                usersClass.updateUser(user, () => {
                    BtnLoaderMod.load(document.getElementById('save_changes_button'), () => {
                        UserMod.failedAction('formUpdateUser');
                        MessageMod.success("User Successfully Updated");
                    });
                  }, (response) => {
                      BtnLoaderMod.load(document.getElementById('save_changes_button'), () => {
                        $('#formUpdateUser .message').html('');
                        $('#formUpdateUser :input').prop('readonly', false);
                        MessageMod.fail(response.message);
                      });
                  });
            }
        });
    })
})