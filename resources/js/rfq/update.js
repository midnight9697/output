import { PRValidator } from "../PR/validation";
import { MessageMod, confirmMod } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { rfqClass } from "./rfq";
import { RFQSpecsValidation, RFQValidator } from "./validation";
document.addEventListener('DOMContentLoaded', () => {
    let form = document.getElementsByClassName('formCreateRFQSpec')[0];
    rfqClass.fetch_rfq({id: localStorage.getItem('rfq_id')}, fetchRFQ);
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

function fetchRFQ(rfq) {
    rfq = rfq.data;
    $('#classification_dropdown').dropdown('set selected', rfq.classification);
    document.getElementsByName('project_purpose')[0].value = rfq.project_purpose;
    document.getElementsByName('rfq_number')[0].value = rfq.rfq_number;
    document.getElementsByName('attachment_one')[0].value = rfq.attachment_one;
    document.getElementsByName('approved_budget')[0].value = rfq.aproved_budget;
    document.getElementsByName('standard_unit')[0].value = rfq.standard_unit;
    document.getElementsByName('target_deliver_date')[0].value = rfq.target_delivery_date;

    RFQValidator.items = rfq.items;
    specsTable(rfq.items);
}

RFQValidator.CreateRFQValidation((e) => {
    e.preventDefault();
    let data = {
        'id': localStorage.getItem('rfq_id'),
        'project_purpose': PRValidator.serializeArrayToJson('.formCreateRFQ').project_purpose,
        'rfq_number': PRValidator.serializeArrayToJson('.formCreateRFQ').rfq_number,
        'attachment_one': PRValidator.serializeArrayToJson('.formCreateRFQ').attachment_one,
        'aproved_budget': PRValidator.serializeArrayToJson('.formCreateRFQ').approved_budget,
        'standard_unit': PRValidator.serializeArrayToJson('.formCreateRFQ').standard_unit,
        'target_delivery_date': PRValidator.serializeArrayToJson('.formCreateRFQ').target_deliver_date,
        'classification': PRValidator.serializeArrayToJson('.formCreateRFQ').classification,
        'items': RFQValidator.items
    }
    confirmMod.load(() => {
        rfqClass.updateRFQ(data, (e) => {
            MessageMod.success("Changes Saved.!", () => {
                window.location.reload(true);
            });
        });
    },"Save changes ?");
});

RFQSpecsValidation.CreateRFQItemValidation((e) => {
    e.preventDefault();
    RFQValidator.items = (RFQValidator.items?RFQValidator.items:[]);
    RFQValidator.items.push(RFQValidator.serializeArrayToJson('.formCreateRFQSpec'));
    console.log('Serialze', RFQValidator.items);
    $('.formCreateRFQSpec').form('reset');
    $('#modalCreateRFQSpec').modal('hide');
    console.log(RFQValidator.items);
    MessageMod.warning('Save changes to take reflect.',() => {
        MessageMod.hide();
    })
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
        MessageMod.warning('Please save changes to reflect.', () => {
           MessageMod.hide();
        });
        specsTable(RFQValidator.items);
    });
    TBLButton.relinitialize();
}