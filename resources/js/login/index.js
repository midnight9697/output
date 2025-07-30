import { MessageMod } from "../app";
import { AuthClass } from "./login";

document.addEventListener('DOMContentLoaded', () => {
    $('#loginForm').on('submit', (e) => {
        e.preventDefault();
        AuthClass.authenticate({
            email: $('#email').val(),
            password: $('#password').val(),
        }, (rsponse) => {
            if (rsponse.data.auth == 1) {
                localStorage.setItem('bearer', rsponse.data.bearer);
                localStorage.setItem('token_id', rsponse.data.tokenId);
                window.location = 'dashboard';
            }
            else {
                $('.ui.form').form('add errors', ['Invalid username or password.']);
            }
        });
    });
});