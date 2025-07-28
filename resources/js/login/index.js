import { AuthClass } from "./login";

document.addEventListener('DOMContentLoaded', () => {
    $('#loginForm').on('submit', (e) => {
        e.preventDefault();
        console.log('Shit');
        AuthClass.authenticate({
            email: $('#email').val(),
            password: $('#password').val(),
        }, (rsponse) => {
            if (rsponse.data.auth == 1) {
                localStorage.setItem('bearer', rsponse.data.bearer);
                localStorage.setItem('token_id', rsponse.data.tokenId);
                window.location = 'dashboard';
            }
        });
    });
});