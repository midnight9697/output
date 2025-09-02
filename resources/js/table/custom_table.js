import { PRValidator } from "../PR/validation";

export default class Custom_table {
        
    constructor(element, download, pagination, search, info, url = '') {
        this.element = element;
        this.download = download;
        this.pagination = pagination;
        this.search = search;
        this.info = info;
        this.url = url;
        this.items = [];
        this.target_date = 3;
        this.targets = [];
        this.getItems = (items) => {};
        this.custom_buttons = () => {}
        self = this;
        this.dataSrc = function(json) {
            self.getItems(json);
            console.log(json);
            return json.data;
        }
        // this.setEditor();
        // this.table = this.initialize_table(element, this.download, this.pagination, this.search, this.info);
        $(element).removeClass("hidden");
    }

    set add_row(row) {
        this.add_row(row);
    }

    set add_multiple_row(row) {
        this.add_multiple_rows(row);//[[]]
    }

    set remove_row(element) {
        this.remove_row(element);
    }

    load(columns = []) {
        this.columns = columns;
        // this.editAction = editAction;
        this.initialize_table();
    }

    initialize_table(element = this.element, download = this.download, pagination = this.pagination, search = this.search, info = this.info) {
        self = this;
        let cnt = element=='#payments_table'?15:$(element+' tr th').length;
        let ar = [];

        for (let m = 0; m < (cnt-1); m++) {
            ar.push(m);
        }

        let TBColumns = [];

        this.columns.forEach(column => {
            TBColumns.push({
                data: column
            });
        });

        TBColumns.push({
            data: null,
            render: self.custom_buttons
        });

        var current_table = new DataTable(element, {
            processing: true,
            serverSide: true,
            ajax: {
                url: self.url,
                type: 'GET',
                "beforeSend": function (xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('bearer'));
                },
                dataSrc: self.dataSrc
            },
            "ordering": false,
            "initComplete": function(settings, json) {
                $('.dataTables_filter').addClass('mb-3');
            },
            "order": [
				[0, "desc"]
			],
            
            columns: TBColumns,/*[
                { data: 'entity_name' },
            ],*/
            columnDefs: [
                {
                    targets: "_all", // Index of firstName and lastName columns
                    // visible: false,
                    className: 'text-center'
                }
            ],
            lengthChange: false,
            select: false,
            paging: pagination,
            searching: search,
            info: info,
            responsive: true
        });
        this.table = current_table;
        return current_table
    }

    add_row(row) {
        console.log('add', document.getElementById(this.element));
        this.table.row.add(row).draw(false);
    }

    add_multiple_rows(row) {
        this.table.rows.add(row).draw(false);
    }

    remove_row(element) {
        this.table.row( $(element).parents('tr') )
        .remove()
        .draw();
    }

    row_data(element) {
        let findtr = $(element).parent().parent();
        return this.table.row(findtr).data();
    }

    remove_rows() {
        this.table
        .rows()
        .remove()
        .draw();
    }

    reset() {
        $(this.element).dataTable().fnClearTable();
        $(this.element).dataTable().fnDestroy();
    }

    sort_order(orders = []) { // [0, 'asc']
        this.table.order(orders);
    }

    page_length(pages) { // numbers
        this.table.page.len(pages);
    }
}
