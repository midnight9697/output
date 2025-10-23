import { TBLButton, tableButtons } from "../table/buttons";
import { rfqClass } from "../rfq/rfq";
import Custom_table from "../table/custom_table";
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

    $('.create-abstarct-button').on('click', () => {
        $('.form-create-abstract').trigger('submit')
    });

    $('.submit_bidder_button').on('click', () => {
        $('.form-abstract-bid').trigger('submit');
    })

    $('.ui.dropdown.suppliers').dropdown({
        onChange: function(value, text, $choice) {
            if (typeof $choice == "object") {
                selectedSuppliers = selectedSuppliers.filter(el => (value.includes(el.id.toString())));
            }
            else {
                value.forEach(supplier_id => {
                    if (selectedSuppliers.filter(el => el.id == supplier_id).length == 0) {
                        selectedSuppliers.push({ name:$choice, id: supplier_id});
                    }
                });
            }
            let suppliers = [];
            selectedSuppliers.forEach(bidder => {
                let unitprice = document.getElementById('unitprice'+bidder.id);
                let unitcost = document.getElementById('unitcost'+bidder.id);
                bidder.unit_cost = unitcost.value;
                bidder.unit_price = unitprice.value;
                bidder.bidder_id =bidder.id;
                suppliers.push(bidder);
            });
            current_item.bidders = selectedSuppliers;
            items = items.filter(el => el.id != current_item.id);
            items.push(current_item);
            biddersTable(selectedSuppliers);
        }
    });

    $('.ui.dropdown.rfqs').dropdown({
        onChange: function(value, text, $choice) {
            rfqClass.fetch_rfq({
                ids: value
            }, (response) => {
                projectsTable(response.data);
            })
        }
    });

    abstractBidValidator.CreateAbstractValidation((e) => {
        e.preventDefault();
        console.log('working...');
        let unit_prices = [];
        let unit_costs = [];
        selectedSuppliers.forEach(bidder => {
            let unitprice = document.getElementById('unitprice'+bidder.id);
            let unitcost = document.getElementById('unitcost'+bidder.id);
            unit_prices.push({
                bidder_id: bidder.id,
                unit_price: unitprice.value,
            })
            unit_costs.push({
                bidder_id: bidder.id,
                unit_cost: unitcost.value,
            })
        });     
        console.log('Payload',{
            purpose: $('#purpose').val(),
            rfq_ids: [$('.ui.dropdown.rfqs').dropdown('get value')],
            'items': items, //items with bidders
            'unit_costs': unit_costs,//items with bidders
            'unit_prices': unit_prices //items with bidders 
        });
        return  [];
        abstractController.create({
            purpose: $('#purpose').val(),
            rfq_ids: [$('.ui.dropdown.rfqs').dropdown('get value')],
            'items': items, //items with bidders
            'unit_costs': unit_costs,//items with bidders
            'unit_prices': unit_prices //items with bidders 
        }, (res) => {
            MessageMod.success('Abstract Created', () => {
                window.location.reload();
            });
        })
    })

    abstractBidValidator.CreateAbstractBidValidation((e) => {
        e.preventDefault();
        console.log('Working', items);
        MessageMod.success('Successfully saved');
    })

    rfqClass.fetch_rfq({
        ids:  $('.ui.dropdown.rfqs').dropdown('get value')
    }, (response) => {
        let rfq_items = response.data;
        abstractController.fetch_bidders($('.ui.dropdown.rfqs').dropdown('get value'), (bidders_response) => {
            projectsTable(bidders_response.data);
        });
    });
});

function biddersTable(bids) {
    
    let projectrow = "";
    const biddersTableButton = new tableButtons();

    for (let i = 0; i < bids.length; i++) {
        const bid = bids[i];
        projectrow += `
            <tr>
                <td>${bid.name}</td>
                <td><input type="text" class="supplier_unit_price" id="unitprice${bid.id}" name="unit_price"  data-supplier="${bid.id}"placeholder=""></td>
                <td><input type="text" class="supplier_unit_cost" id="unitcost${bid.id}" name="unit_cost" data-supplier="${bid.id}" placeholder=""></td>
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
    let bidders = data.rfq_bidders;
    let projects = data.items;
    let suppliers = data.suppliers;
    console.log(data);
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
        return item;
    });
    let projectrow = "";
    for (let i = 0; i < projects.length; i++) {
        const proj = projects[i];
        console.log('Shit', proj);
        let parent = document.createElement('div');
        TBLButton.data = proj;
        TBLButton.updateAction = true;
        TBLButton.updateClassName = "updateItem";
        TBLButton.loadButtons(parent);
        let supplierRow = "";
        suppliers.forEach(supplier => {
            supplierRow += `
                <td>${(proj.abstract_item?(proj.abstract_item.supplier.name == supplier.name?proj.abstract_item.unit_cost:""):"")}</td>
                <td>${(proj.abstract_item?(proj.abstract_item.supplier.name == supplier.name?proj.abstract_item.total_cost:""):"")}</td>
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
        selectedSuppliers = [];
        current_item = {
            id: e.target.dataset.id,
            specification: e.target.dataset.specification,
            quantity_unit: e.target.dataset.quantity_unit,
            unit_price: e.target.dataset.unit_price,
            total_price: e.target.dataset.total_price,
            rfq_id: e.target.dataset.rfq_id,
        };
        
        $('#description').val(e.target.dataset.specification);
        $('#quantity').val(e.target.dataset.quantity_unit);
        $('#unit_price').val(e.target.dataset.unit_price);
        $('#total_price').val(e.target.dataset.total_price);
        $('#addBiddderModal').modal('show');
    });
    TBLButton.relinitialize();
}