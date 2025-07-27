import { CustomTable } from "../custom_table";
import { PRClass } from "./purchase_request";

document.addEventListener('DOMContentLoaded', () => {
    const prTable = new CustomTable('prs_table', [
        'PR No.', 'Fund Cluster', 'Office',
        'Entity Name', 'Date', 'Responsibility Code',
        'Purpose'
    ], ['pr_number', 'fund_cluster', 'office', 'entity_name', 'date', 'responsibility_center_code', 'purpose']);

    PRClass.getByPage((paging) => {
        console.log('Purchase Request', paging);
        // UserMod.fetchUsersTable(paging)
    });

    prTable.load([{
        entity_name: 'Marco Pantonial',
        fund_cluster: 'PISMU',
        office: 'PISMU',
        pr_number: '123456',
        date: 'July 25, 2025',
        responsibility_center_code: 'DONT KNOW',
        purpose: 'Walang Purpose',
        approver: 'Vincent Morastil',
        requester: 'Jay Arwim Lipayon'
    }]);
});
