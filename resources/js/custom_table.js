export class CustomTable {
    constructor(parent, column, data, keys) {
        this.parent = document.getElementById(parent);
        this.column = column;
        this.data = data;
        this.keys = keys;
    }

    load() {
        this.table = document.createElement('table');
        this.thead = document.createElement('thead');
        this.theadRow = document.createElement('tr');
        
        this.column.forEach(col => {
            let theadCol = document.createElement('th');
            theadCol.innerHTML = col;
            this.theadRow.appendChild(theadCol);
        });
        this.thead.appendChild(this.theadRow);
        this.table.appendChild(this.thead);
        this.table.className = "ui very basic collapsing celled table";
        this.table.style = "width:100%";
        this.parent.appendChild(this.table);

    }
}