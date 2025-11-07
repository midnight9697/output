import { global_place } from '../app';
// import { MessageMod } from "../app";
// import { SupplierValidation } from "../supplier/validation";
// import { TBLButton } from "../table/buttons";
// import { SupplierControl } from "./supplier";
import { PurchaseOrderClass } from "./purchase_order";
import {  PurchaseOrderValidator } from "./validation";

const supplier_name = document.getElementById('supplier_name');

document.addEventListener('DOMContentLoaded', () => {

//   global_place('supplier_province', 'supplier_municipality', 'supplier_barangay')

    $('.submit_purchase_order_form_button').on('click', function() {
        $('#formCreatePurchaseOrder').trigger('submit');
    });

    PurchaseOrderValidator.CreatePurchaseOrderValidation((e) => {
        e.preventDefault();
        let data = {
            'supplier_name': PurchaseOrderValidator.serializeArrayToJson('.formCreatePurchaseOrder').supplier_name,
        }
        PurchaseOrderClass.creatpurchase_order(data, (e) => {
            console.log('data', data);
        });
    });

    PurchaseOrderClass.fetch_suppliers({}, (data) => {
        supplier_name.innerHTML = ''; 
        data.forEach(el => {
          let opt = document.createElement('option');
          opt.value = el.id;
          opt.textContent = el.name;
          supplier_name.appendChild(opt);
        });
      });
      
      supplier_name.onchange = (e) => {
        const id = e.target.value;
        const d = JSON.stringify({ id: id });
        PurchaseOrderClass.select_supplier(d);
        console.log(d);
      };
      
      
})
