import { itemsTable } from "./create";
import { PRClass } from "./purchase_request";
import { PRValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {
    PRValidator.CreatePRValidation((e) => {
        e.preventDefault();
    }, 'updatepr');

    PRClass.getPrItems(localStorage.getItem('pr_id'), (data) => {
        PRValidator.items = data;
        itemsTable();
    });
});