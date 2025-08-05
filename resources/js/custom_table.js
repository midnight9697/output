export class CustomTable {
    constructor(parent, column, keys) {
        this.parent = document.getElementById(parent);
        this.column = column;
        this.data = [];
        this.keys = keys;
    }

    load(data = [], tableMod) {
        tableMod.data = data;

        tableMod.table = document.createElement('table');
        tableMod.theadRow = document.createElement('tr');
        
        tableMod.column.forEach(col => {
            let theadCol = document.createElement('th');
            theadCol.innerHTML = col;
            tableMod.theadRow.appendChild(theadCol);
        });
        
        tableMod.table.appendChild(tableMod.theadRow);

        tableMod.data.forEach(row => {
            let tbodyRow = document.createElement('tr');
            // tableMod.keys.forEach(key => {
            //     let tbodyCol = document.createElement('td');
            //     tbodyCol.innerHTML = row[key];
            //     tbodyRow.appendChild(tbodyCol);
            // });
            // tableMod.table.appendChild(tbodyRow);
        });
        tableMod.table.className = "ui very basic collapsing celled table";
        tableMod.table.style = "width:100%";
        tableMod.parent.appendChild(this.table);

    }
}
