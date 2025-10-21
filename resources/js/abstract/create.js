import { TBLButton, tableButtons } from "../table/buttons";
import { rfqClass } from "../rfq/rfq";
import Custom_table from "../table/custom_table";
import { abstractBidValidator } from "./validation";
import { abstractController } from "./abstract";
let selectedSuppliers = [];
let current_item = {};
let items = [];
document.addEventListener('DOMContentLoaded', () => {
    
    $('.create-abstarct-button').on('click', () => {
        $('.form-create-abstract').trigger('submit')
    });

    $('.submit_bidder_button').on('click', () => {
        $('.form-abstract-bid').trigger('submit');
    })

    $('.ui.dropdown.suppliers').dropdown({
        onChange: function(value, text, $choice) {
            console.log('ITEMS', items);
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
                console.log(response);
                projectsTable(response.data);
            })
        }
    });

    abstractBidValidator.CreateAbstractValidation((e) => {
        e.preventDefault();
        console.log('working...');
        abstractController.create({
            purpose: $('#purpose').val(),
            rfq_ids: $('.ui.dropdown.rfqs').dropdown('get value'),
            'items': items //items with bidders 
        }, (res) => {
            console.log('response', res);
        })
    })

    abstractBidValidator.CreateAbstractBidValidation((e) => {
        e.preventDefault();
        console.log('Working', items);
    })

    rfqClass.fetch_rfq({
        ids:  $('.ui.dropdown.rfqs').dropdown('get value')
    }, (response) => {
        projectsTable(response.data);
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
                <td><input type="text" class="unit_price" id="unit_price[]" name="unit_price" placeholder=""></td>
                <td><input type="text" class="unit_cost" id="unit_cost[]" name="unit_cost" placeholder=""></td>
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

function projectsTable(projects) {
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
        projectrow += `
            <tr>
                <td>${(i+1)}</td>
                <td>${proj.quantity_unit}</td>
                <td></td>
                <td>${proj.specification}</td>
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
            total_price: e.target.dataset.total_price
        };

        $('#description').val(e.target.dataset.specification);
        $('#quantity').val(e.target.dataset.quantity_unit);
        $('#unit_price').val(e.target.dataset.unit_price);
        $('#total_price').val(e.target.dataset.total_price);
        $('#addBiddderModal').modal('show');
    });
    TBLButton.relinitialize();
}