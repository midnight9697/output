import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";

var active_table;
var items_table;
document.addEventListener('DOMContentLoaded', () => {
    active_table = new Custom_table('#abstract-table', false, true, false, false, './api/abstract/page')
    items_table = document.getElementById('#abstract-items-body')

    // $('#quotation')
    // .dropdown({
    //   apiSettings: {
    //     url: '/api/your-search-endpoint?query={query}', // Your server-side endpoint
    //     method: 'GET' // or 'POST' depending on your API
    //   },
    //   fields: {
    //     name: 'name', // The field in your API response to display
    //     value: 'value' // The field in your API response for the actual value
    //   },
    //   minCharacters: 2, // Minimum characters to type before making an API call
    //   // ... other dropdown settings
    // });

    $('#create_abstract_vbtn').on('click', () => {
        window.location = './abstract/create';
    });

    items_table.custom_buttons = (data) => {
        let div = document.createElement('div');
        TBLButton.loadButtons(div);
        return div;
    };

    active_table.load([
        'title',
        'purpose',
        'created_at',
    ]);
});
