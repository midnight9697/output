export class CustomTable {
    constructor(parent, column, keys) {
        this.parent = document.getElementById(parent);
        this.column = column;
        this.data = [];
        this.keys = keys;
    }

    load(data = []) {
        this.data = data;
        this.table = document.createElement('table');
        this.theadRow = document.createElement('tr');
        
        this.column.forEach(col => {
            let theadCol = document.createElement('th');
            theadCol.innerHTML = col;
            this.theadRow.appendChild(theadCol);
        });

        this.table.appendChild(this.theadRow);

        this.data.forEach(row => {
            let tbodyRow = document.createElement('tr');
            this.keys.forEach(key => {
                let tbodyCol = document.createElement('td');
                tbodyCol.innerHTML = row[key];
                tbodyRow.appendChild(tbodyCol);
            });
            this.table.appendChild(tbodyRow);
        });
        this.table.className = "ui very basic collapsing celled table";
        this.table.style = "width:100%";
        this.parent.appendChild(this.table);

    }
}