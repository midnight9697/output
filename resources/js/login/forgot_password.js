import { GValidator } from "../login/validation";
import { BtnLoaderMod, MessageMod } from "../app";
import { AuthClass } from "./login";

document.addEventListener('DOMContentLoaded', () => {
    GValidator.passwordResetValidation((e) => {
        e.preventDefault()
        BtnLoaderMod.start(document.getElementById('update_password_button'))
        AuthClass.forgot_password((res) => {
            console.log('result', res);
            BtnLoaderMod.load(document.getElementById('update_password_button'), () => {
                if (res.data.result == 1) {
                    MessageMod.success("Email successully sent");
                }
                else {
                    MessageMod.fail("Email does not exist in the system");
                }
            }, "SUBMIT");
        }, document.getElementById('email').value);
    });
});