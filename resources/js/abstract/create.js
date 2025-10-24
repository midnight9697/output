import { TBLButton, tableButtons } from "../table/buttons";
import { abstractBidValidator } from "./validation";
import { abstractController } from "./abstract";
import { MessageMod } from "../app";
import { map } from "lodash";
let selectedSuppliers = [];
let current_item = {};
let items = [];
let abstract_header_columns;
let main_header_column;
document.addEventListener('DOMContentLoaded', () => {
    abstract_header_columns = document.getElementById('abstract-header-columns');
    main_header_column = abstract_header_columns.children[0].innerHTML;

    $('#addBiddderModal')
    .modal({
        onHide: function() {
            current_item = {};
            console.log(current_item);
        }
    });

    $('.create-abstarct-button').on('click', () => {
        $('.form-create-abstract').trigger('submit')
    });

    abstractBidValidator.CreateAbstractValidation((e) => {
        e.preventDefault();
        let tmp_item = items.map(el => {
            return el.id == current_item.id?current_item:el;
        });
        console.log('tmp_item', current_item);
    });

    abstractController.fetch_bidders($('.ui.dropdown.rfqs').dropdown('get value'), (bidders_response) => {
        projectsTable(bidders_response.data);
    });
});

function biddersTable(bids) {
    
    let projectrow = "";
    const biddersTableButton = new tableButtons();

    for (let i = 0; i < bids.length; i++) {
        const bid = bids[i];
        projectrow += `
            <tr>
                <td>${bid.supplier.name}</td>
                <td><input type="text" value="${bid.unit_cost}" class="supplier_unit_price" id="unitprice${bid.supplier.id}" name="unit_price"  data-supplier="${bid.supplier.id}"placeholder=""></td>
                <td><input type="text" value="${bid.total_cost}" class="supplier_unit_cost" id="unitcost${bid.supplier.id}" name="unit_cost" data-supplier="${bid.supplier.id}" placeholder=""></td>
            </tr>
        `;
    }

    if (bids.length == 0) {
        projectrow += `
            <tr>
                <td colspan="12">No Record Found</td>
            </tr>
        `;
    }

    document.getElementById('abstract-bidders-body').innerHTML = projectrow;
   
    biddersTableButton.relinitialize();
}

function projectsTable(data) {
    let projects = data.items;
    let suppliers = data.suppliers;
    let ht_supplier = "";
    abstract_header_columns.innerHTML = "";
    let blank_supplier = ""
    suppliers.forEach(supplier => {
        ht_supplier += `
            <th colspan="2" rowspan="2">${supplier.name}</th>
        `;
    });
    
    abstract_header_columns.innerHTML = `
        <tr>
            <th rowspan="2">ITEM</th>
            <th rowspan="2">QTY</th>
            <th rowspan="2">UNIT</th>
            <th rowspan="2">ITEM/DESCRIPTION</th>
            ${ht_supplier}
            <th rowspan="2">ACTION</th>
        </tr>
        <tr>
            ${blank_supplier}
        </tr>
    `;

    items = projects;
    items = items.map((e) => {
        let item = e;
        item['bidders'] = [];
        item['bidders']['supplier'] = null;
        return item;
    });
    let projectrow = "";
    for (let i = 0; i < projects.length; i++) {
        const proj = projects[i];
        let parent = document.createElement('div');
        TBLButton.data = proj;
        TBLButton.updateAction = true;
        TBLButton.udpateName = "Supplier";
        TBLButton.updateClassName = "updateItem";
        TBLButton.loadButtons(parent);
        let supplierRow = "";
        suppliers.forEach(supplier => {
            let hasBidder = proj.abstract_items.find(el => el.supplier.name == supplier.name);
            supplierRow += `
                <td>${(hasBidder?hasBidder.unit_cost:"")}</td>
                <td>${(hasBidder?hasBidder.total_cost:"")}</td>
            `;
        });
        projectrow += `
            <tr>
                <td>${(i+1)}</td>
                <td>${proj.quantity_unit}</td>
                <td></td>
                <td>${proj.specification}</td>
                ${supplierRow}
                <td>${parent.innerHTML}</td>
            </tr>
        `;
    }
    if (projects.length == 0) {
        projectrow += `
            <tr>
                <td colspan="12">No Record Found</td>
            </tr>
        `;
    }
    document.getElementById('abstract-items-body').innerHTML = projectrow;
    $('.updateItem').on('click', (e) => {
        $('.ui.dropdown.suppliers').dropdown('clear');
        let item = items.find(el => el.id == e.target.dataset.id);
        let selected = [];
        selectedSuppliers = [];
        current_item = item;
        item.abstract_items.forEach(abstract_item => {
            selected.push(abstract_item.supplier.name);
        });
        console.log(current_item);
        biddersTable(item.abstract_items);
        $('.ui.dropdown.suppliers').dropdown('set selected', selected);
        $('#description').val(e.target.dataset.specification);
        $('#quantity').val(e.target.dataset.quantity_unit);
        $('#unit_price').val(e.target.dataset.unit_price);
        $('#total_price').val(e.target.dataset.total_price);
        $('#addBiddderModal').modal('show');
    });
    TBLButton.relinitialize();
}
