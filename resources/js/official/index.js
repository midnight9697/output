import Custom_table from "../table/custom_table";

document.addEventListener('DOMContentLoaded', () => {
    // let active_table = new Custom_table('#eia_table', true, true, true, true);
    const active_table = new Custom_table('#eia_table', false, true, false, false);
    active_table.load(['test','test','test','test','test','test']);
    console.log('====================================');
    console.log("hello");
    console.log('====================================');
});