import { MessageMod } from "../app";
import { AuthClass } from "./login";
import { GValidator } from "./validation";

$(document).ready(function() { 
    GValidator.loginValidation((e) => {
        e.preventDefault();
        const dimmer = $('#loginSegment .ui.dimmer');
        dimmer.addClass('blinking');
        document.getElementById('loader-text').innerHTML = `
            Authenticating...
        `;
        $('#loginSegment').dimmer('show');
          AuthClass.authenticate({
            email: $('#email').val(),
            password: $('#password').val(),
        }, (rsponse) => {
            dimmer.removeClass('blinking');
            if (rsponse.data.auth == 1) {
                localStorage.setItem('bearer', rsponse.data.bearer);
                localStorage.setItem('token_id', rsponse.data.tokenId);
                let timeout = setInterval(() => {
                    $('#loginSegment').dimmer('show', { silent: true }).promise().done(() => {
                        dimmer.removeClass('blinking').addClass('success');
                    let timeout = setInterval(() => {
                        document.getElementById('loader-text').innerHTML = `
                            Success<br>
                            Please wait...
                        `;
                        window.location = "./dashboard";
                    });
                    });
                }, 500);
               
            }
            else {
                $('.ui.form').form('add errors', ['Invalid username or password.']);
                // $('#login-dimmer').dimmer('hide');
                $('#loginSegment').dimmer('show', { silent: true }).promise().done(() => {
                    document.getElementById('loader-text').innerHTML = `
                        Incorrect username or password
                    `;
                    dimmer.removeClass('blinking').addClass('failure');
                });

                let timeout = setInterval(() => {
                    $('#loginSegment').dimmer('hide', { silent: true }).promise().done(() => {
                        dimmer.removeClass('failure').addClass('blinking');
                    });
                }, 500);
            }
        });
    });
});