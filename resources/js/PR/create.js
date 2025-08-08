import { PRClass } from "./purchase_request";
import { PRValidator } from "./validation";

PRValidator.CreatePRValidation((e) => {
    e.preventDefault();
    PRClass.creatPR(PRValidator.serializeArrayToJson('.createpr'), ['test'], (e) => {
        console.log('Shit', e);
    });
});