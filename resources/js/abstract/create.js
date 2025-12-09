import { TBLButton, tableButtons } from "../table/buttons";
import { abstractBidValidator } from "./validation";
import { abstractController } from "./abstract";
import { MessageMod } from "../app";
import { map } from "lodash";
let beforSelectedSuppliers = [];
let selectedSuppliers = [];
let current_item = {};
let items = [];
let all_supplier_lists = [];
let abstract_header_columns;
let main_header_column;
let all_selected_suppliers = [];
document.addEventListener('DOMContentLoaded', () => {
    abstract_header_columns = document.getElementById('abstract-header-columns');
    main_header_column = abstract_header_columns.children[0].innerHTML;

    $('.submit_bidder_button').on('click', () => {
        $('.form-abstract-bid').trigger('submit');
    })

    $('.ui.dropdown.suppliers').dropdown({
        onChange: function(value, text, $choice) {
            if (typeof $choice == "object") {
                console.log(selectedSuppliers);
                selectedSuppliers = selectedSuppliers.filter(el => (value.includes(el.supplier.name)));
            }
            else {
                value.forEach(supplier_name => {
                    if (selectedSuppliers.filter(el => el.supplier.name == supplier_name).length == 0) {
                        let supplier = (current_item.abstract_items.find(el => el.supplier.name == text)?current_item.abstract_items.find(el => el.supplier.name == text):{
                            supplier:all_supplier_lists.find(el => el.name == text),
                            unit_cost: '',
                            total_cost: '',
                            winning_bidder: '0',
                        });
                        
                        selectedSuppliers.push(supplier);
                    }
                });
            }
            if (!all_selected_suppliers.includes(text)) {
                all_selected_suppliers.push(text);
            }
            biddersTable(selectedSuppliers);
            console.log(selectedSuppliers);
        }
    });

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

    abstractBidValidator.CreateAbstractBidValidation((e) => {
        e.preventDefault();
        let tmp_suppliers = $('.ui.dropdown.suppliers').dropdown('get value');
        console.log('all selected suppliers', all_selected_suppliers);
        projectsTable({
            'items': items,
            'all_supplier_lists': all_supplier_lists,
            'suppliers': all_supplier_lists.filter(el => all_selected_suppliers.includes(el.name))
        });
        $('#addBiddderModal').modal('hide');
    })

    abstractBidValidator.CreateAbstractValidation((e) => {
        e.preventDefault();
        abstractController.create({
            purpose: $('#purpose').val(),
            rfq_ids: [$('.ui.dropdown.rfqs').dropdown('get value')],
            'items': items, //items with bidders
        }, (res) => {
            MessageMod.success('Abstract Created', () => {
                window.location.reload();
            });
        })
    });

    abstractController.fetch_bidders($('.ui.dropdown.rfqs').dropdown('get value'), (bidders_response) => {
        projectsTable(bidders_response.data);
    });
});

function biddersTable(bids) {
    $('.winner').prop('checked', false);
    current_item.abstract_items = selectedSuppliers;
    let projectrow = "";
    const biddersTableButton = new tableButtons();
    let current_abstract_items = [];
    for (let i = 0; i < bids.length; i++) {
        const bid = bids[i];
        
        current_abstract_items.push(bid);
        projectrow += `
            <tr>
                <td>${bid.supplier.name}</td>
                <td><input type="text" value="${bid.unit_cost}" class="supplier_unit_price" data-supplier_name="${bid.supplier.name}" id="unitprice${bid.supplier.id}" name="unit_price"  data-supplier="${bid.supplier.id}"placeholder=""></td>
                <td><input type="text" value="${bid.total_cost}" class="supplier_unit_cost" data-supplier_name="${bid.supplier.name}" id="unitcost${bid.supplier.id}" name="unit_cost" data-supplier="${bid.supplier.id}" placeholder=""></td>
                <td>
                    <div class="ui checkbox">
                      <input type="radio" ${bid.winning_bidder == 1?"checked":""} name="winner"  id="winner-${bid.id}" data-id="${bid.id}" class="winner"> 
                      <label>YES</label>
                    </div>
                </td>
            </tr>
        `;
    }
    items = items.map((el) => {
        return (el.id == current_item.id?current_item:el);
    });
    if (bids.length == 0) {
        projectrow += `
            <tr>
                <td colspan="12">No Record Found</td>
            </tr>
        `;
    }

    document.getElementById('abstract-bidders-body').innerHTML = projectrow;
    
    $('.clear_winner').on('click', () => {
        let abstract_items = current_item.abstract_items;
        $('.winner').prop('checked', false);
        abstract_items = abstract_items.map(el => {
            el.winning_bidder = '0';
            return el;
        });
        current_item.abstract_items = abstract_items;
    });

    $('.winner').on('change', (e) => {
        let abstract_items = current_item.abstract_items;
        let abstract_item = abstract_items.find(el => el.id == e.target.dataset.id);
        console.log(abstract_items);
        console.log('checked? ', e.target.checked);
        abstract_items = abstract_items.map(el => {
            el.winning_bidder = (el.id == abstract_item.id?abstract_item.winning_bidder:'0');
            console.log('Match ?', el.id == abstract_item.id);
            return el;
        });
        current_item.abstract_items = abstract_items;
    });

    $('.supplier_unit_price').on('input', (e) => {
        console.clear();
        let abstract_item = current_item.abstract_items.find(el => el.supplier.name == e.target.dataset.supplier_name);
        abstract_item = (abstract_item?abstract_item:{
            'supplier': all_supplier_lists.find(el => el.name == e.target.dataset.supplier_name),
            'unit_cost': '',
            'total_cost': '',
            'winning_bidder': '0'
        })
        abstract_item.unit_cost = e.target.value;
        current_item.abstract_items = current_item.abstract_items.map(el => {
            if (el.supplier.name == abstract_item.supplier.name) {
                return abstract_item;
            }
            return el;
        });
        items = items.map(el => {
            return (current_item.id == el.id?current_item:el);
        });
        console.log('items', items);
    });

    $('.supplier_unit_cost').on('input', (e) => {
        console.clear();
        let abstract_item = current_item.abstract_items.find(el => el.supplier.name == e.target.dataset.supplier_name);
        abstract_item = (abstract_item?abstract_item:{
            'supplier': all_supplier_lists.find(el => el.name == e.target.dataset.supplier_name),
            'unit_cost': '',
            'total_cost': '',
            'winning_bidder': '0'
        })
        abstract_item.total_cost = e.target.value;
        current_item.abstract_items = current_item.abstract_items.map(el => {
            if (el.supplier.name == abstract_item.supplier.name) {
                return abstract_item;
            }
            return el;
        });
        items = items.map(el => {
            return (current_item.id == el.id?current_item:el);
        });
        console.log('items', items);
    });
    biddersTableButton.relinitialize();
}

function projectsTable(data) {
    let projects = data.items;
    all_supplier_lists = data.all_supplier_lists;
    let suppliers = data.suppliers;
    let ht_supplier = "";
    abstract_header_columns.innerHTML = "";
    let blank_supplier = ""
    suppliers.forEach(supplier => {
        ht_supplier += `
            <th style="text-align:center" colspan="2">${supplier.name}</th>
        `;
        if (!all_selected_suppliers.includes(supplier.name)) {
            all_selected_suppliers.push(supplier.name);
        }

        blank_supplier += `
            <th style="width:120px;text-align:center">UNIT COST</th>
            <th style="width:120px;text-align:center">TOTAL COST</th>
        `;
    });
    
    abstract_header_columns.innerHTML = `
        <tr>
            <th style="text-align:center">ITEM</th>
            <th style="text-align:center">QTY</th>
            <th style="text-align:center">UNIT</th>
            <th style="text-align:center">ITEM/DESCRIPTION</th>
            ${ht_supplier}
            <th rowspan="2">ACTION</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            ${blank_supplier}
        </tr>
    `;

    items = projects;
    // items = items.map((e) => {
    //     let item = e;
    //     item['bidders'] = [];
    //     // item['bidders']['supplier'] = null;
    //     return item;
    // });
    let projectrow = "";
    for (let i = 0; i < projects.length; i++) {
        const proj = projects[i];
        let parent = document.createElement('div');
        TBLButton.data = proj;
        TBLButton.updateAction = true;
        TBLButton.udpateName = "BIDDERS";
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
        console.log('Shit', current_item.abstract_items);
        item.abstract_items.forEach(abstract_item => {
            selected.push(abstract_item.supplier.name);
            
            selectedSuppliers.push(abstract_item);
        });
        biddersTable(selectedSuppliers);
        $('.ui.dropdown.suppliers').dropdown('set selected', selected);
        $('#description').val(e.target.dataset.specification);
        $('#quantity').val(e.target.dataset.quantity_unit);
        $('#unit_price').val(e.target.dataset.unit_price);
        $('#total_price').val(e.target.dataset.total_price);
        $('#addBiddderModal').modal('show');
    });
    TBLButton.relinitialize();
}
