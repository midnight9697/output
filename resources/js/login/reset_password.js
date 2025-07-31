import { MessageMod } from "../app";
import { AuthClass } from "./login";
import { GValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {
    GValidator.passwordChangeValidation(() => {
        AuthClass.reset_password((res) => {
            MessageMod.success("Password successfully change.");
            window.location.reload();
        }, document.getElementById('password').value);
    });
});