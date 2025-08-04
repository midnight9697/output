import { CustomTable } from "../custom_table";
import { PRClass } from "./purchase_request";

document.addEventListener('DOMContentLoaded', () => {
    const prTable = new CustomTable('prs_table', [
        'PR No.', 'Fund Cluster', 'Office',
        'Entity Name', 'Date', 'Responsibility Code',
        'Purpose'
    ], ['pr_number', 'fund_cluster', 'office', 'entity_name', 'created_at', 'responsibility_center_code', 'purpose']);

    PRClass.getByPage((data) => {
        prTable.load(data, prTable);
    });

});