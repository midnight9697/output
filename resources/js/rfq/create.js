import { PRClass } from "../PR/purchase_request";
import { PRValidator } from "../PR/validation";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { rfqClass } from "./rfq";
import { RFQSpecsValidation, RFQValidator } from "./validation";
document.addEventListener('DOMContentLoaded', () => {
    let form = document.getElementsByClassName('formCreateRFQSpec')[0];
    $('.add_item_button').on('click', function() {
        $('#modalCreateRFQSpec').modal('show');
    });

    $('.add_rfq_item_button').on('click', () => {
        $('.formCreateRFQSpec').trigger('submit');
    })

    $('.submit_rfq_form_button').on('click', function() {
        $('#formCreateRFQ').trigger('submit');
    });
    
});

PRClass.getPrItems(localStorage.getItem('pr_id'), (data) => {
    let items = data.items;
    let tmp_items = [];
    items.forEach(item => {
        tmp_items.push({
            id: Math.floor(Math.random() * 1000),
            bidder_specs: item.item_description,
            quantity_unit: item.quantity,
            specification: item.item_description,
            total_price: item.total_cost,
            unit_price: item.unit_cost
        })
    });

    RFQValidator.items = [...tmp_items];
    
    specsTable(tmp_items);
});

RFQValidator.CreateRFQValidation((e) => {
    e.preventDefault();
    let data = {
        'project_purpose': PRValidator.serializeArrayToJson('.formCreateRFQ').project_purpose,
        'rfq_number': PRValidator.serializeArrayToJson('.formCreateRFQ').rfq_number,
        'attachment_one': PRValidator.serializeArrayToJson('.formCreateRFQ').attachment_one,
        'aproved_budget': PRValidator.serializeArrayToJson('.formCreateRFQ').approved_budget,
        'standard_unit': PRValidator.serializeArrayToJson('.formCreateRFQ').standard_unit,
        'target_delivery_date': PRValidator.serializeArrayToJson('.formCreateRFQ').target_deliver_date,
        'classification': PRValidator.serializeArrayToJson('.formCreateRFQ').classification,
        'items': RFQValidator.items,
        'pr_id': localStorage.getItem('pr_id')
    }
    rfqClass.creatRFQ(data, (e) => {
        window.location.reload(true);
    });
});

RFQSpecsValidation.CreateRFQItemValidation((e) => {
    e.preventDefault();
    let new_item = RFQValidator.serializeArrayToJson('.formCreateRFQSpec');
    new_item['id'] = Math.floor(Math.random() * 1000);
    RFQValidator.items.push(new_item);
    $('.formCreateRFQSpec').form('reset');
    $('#modalCreateRFQSpec').modal('hide');
    specsTable(RFQValidator.items);
});

function specsTable(specs) {
    let specsrow = "";
    
    specs.forEach(spec => {
        let parent = document.createElement('div');
        TBLButton.data = spec;
        TBLButton.deleteAction = true;
        TBLButton.deleteClassName = "removeItem";
        TBLButton.loadButtons(parent);
        specsrow += `
            <tr>
                <td>${spec.specification}</td>
                <td>${spec.bidder_specs}</td>
                <td>TBA</td>
                <td>${spec.quantity_unit}</td>
                <td>${spec.unit_price}</td>
                <td>${spec.total_price}</td>
                <td>${parent.innerHTML}</td>
            </tr>
        `;
    });

    if (specs.length == 0) {
        specsrow += `
            <tr>
                <td colspan="7">No Record Found</td>
            </tr>
        `;
    }

    document.getElementById('quotation_table_body').innerHTML = specsrow;
    $('.removeItem').on('click', (e) => {
        console.log(e.target.dataset.id);
        RFQValidator.items = RFQValidator.items.filter(el => el.id != e.target.dataset.id);
        specsTable(RFQValidator.items);
    });
    TBLButton.relinitialize();
}