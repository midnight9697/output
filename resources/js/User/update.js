
import { BtnLoaderMod, MessageMod, SectionMod, confirmMod } from "../app";
import { usersClass } from "./User";
import { GValidator } from "./Validation";
import { UserMod } from "./action";

document.addEventListener('DOMContentLoaded', () => {
     // GValidator.form.form('is valid')
    usersClass.getAllUsers((users) => {
        GValidator.UpdateUserValidation(users);
    });

    $('#division').on('change', (e) => {
        document.getElementById('section').innerHTML = '';
        SectionMod.getSection(e.target.value, (data) => {
            data.forEach(section => {
                let option = document.createElement('option');
                option.value = section.id;
                option.innerHTML = section.section;
                document.getElementById('section').appendChild(option);
            });
        })
    });

    $('#formUpdateUser').on('submit', (e) => {
        e.preventDefault();
        usersClass.getAllUsers((users) => {
            let user = {id: localStorage.getItem('user')};
            GValidator.UpdateUserValidation(users);
            if (GValidator.form.form('is valid')) {
                confirmMod.load(() => {
            
                    $('#formUpdateUser :input').prop('readonly', true);
                    BtnLoaderMod.start(document.getElementById('save_changes_button'));
                    $('#formUpdateUser').serializeArray().forEach(data => {
                      user[data.name] = data.value;
                    });

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
                });
            }
        });
        
        
    });

    $('#show_password').on('click', () => {
        const password = document.getElementById('password');
        const password_confirmation = document.getElementById('password_confirmation');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        password_confirmation.setAttribute('type', type);
    })
});