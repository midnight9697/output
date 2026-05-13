export default class Custom_table {
        
    constructor(element, download, pagination, search, info) {
        this.element = element;
        this.download = download;
        this.pagination = pagination;
        this.search = search;
        this.info = info;
        this.table = this.initialize_table(element, this.download, this.pagination, this.search, this.info);
        $(element).removeClass("d-none");
       
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
    
    initialize_table(element, download, pagination, search, info) {
        
        let cnt = element=='#payments_table'?15:$(element+' tr th').length;
        let ar = [];

        for (let m = 0; m < (cnt-1); m++) {
            ar.push(m);
        }
        let args = {
            "initComplete": function(settings, json) {
                $('.dataTables_filter').addClass('mb-3');
            },
            responsive: true,
            "order": [
				[0, "desc"]
			],
            dom: 'Bfrtip',
            buttons: [
                'lengthChange', // Show Entries button
                {
                    extend: 'print', // Print button
                    customize: function ( win ) {
                        $(win.document.body).find( 'thead' ).prepend('<div class="header-print">' + $('#dt-header').val() + '</div>');
                    },
                    text: '<i class="fas fa-print"></i> Print',
				    attr: {
            	    	style: 'background-color:#009900; color: #ffffff;' // Set your desired background and text color
           		    	// Add any other inline styles as needed
        		    },
                    exportOptions: {
                        columns: ar
                    },
                },
            ],
        };
        if (!download) {
            args = { 
                "initComplete": function(settings, json) {
                    $('.dataTables_filter').addClass('mb-3');
                },
                responsive: true 
            };
        }
        args.searching = search;
        args.paging = pagination;
        args.info = info;
        return $(element).DataTable(args);
    }

    add_row(row) {
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

class TailWindTable {
    constructor(element) {
        this.table  = document.getElementById(element);
        this.table.className = 'table table-bordered';
        // this.tableBody  = this.table.theads.departments_thead;
        this.tableBody  = this.table.tBodies.departments_tbody;
        this.columns =  this.table.tHead.children.length>0?this.table.tHead.children[0].children:[];
        // this.add_row();
        this.tableHead  = this.table.tHead;
    }

    add_row = (data = [], columns = []) => {
        let tableRow  = document.createElement('tr');
        let i = 0;
        columns.forEach(column => {
            let tableColumn = document.createElement('td');
            tableColumn.innerHTML = (data[column]?data[column]:data[i]);
            tableRow.appendChild(tableColumn);
            i++;
        });
        this.tableBody.appendChild(tableRow);
    }

    add_head = (data = [], columns = []) => {
        let tableRow  = document.createElement('tr');
        this.tableHead.innerHTML = '';
        columns.forEach(column => {
            let tableColumn = document.createElement('th');
            tableColumn.innerHTML = column;
            tableRow.appendChild(tableColumn);
        });
        this.tableHead.appendChild(tableRow);
    }

    reset() {
        this.tableBody.innerHTML = '';
    }

    restore() {
        this.tableHead.innerHTML = '';
        this.tableBody.innerHTML = '';
    }
}