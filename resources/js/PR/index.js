// import { CustomTable } from "../custom_table";
import Custom_table from "../table/custom_table";
import { PRClass } from "./purchase_request";


document.addEventListener('DOMContentLoaded', () => {
    const PRtable = new Custom_table('#prTable', false, true, true, true, './api/pr/page');
    PRtable.load([
        'entity_name',
        'fund_cluster',
        'office',
        'pr_number',
        'created_at',
        'responsibility_center_code',
        'purpose'
    ]);
});