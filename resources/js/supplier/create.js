import { global_place } from '../app';
// import { MessageMod } from "../app";
// import { SupplierValidation } from "../supplier/validation";
// import { TBLButton } from "../table/buttons";
// import { SupplierControl } from "./supplier";
import { SupplierClass } from "./supplier";
import { SupplierSpecsValidation, SupplierValidator } from "./validation";


document.addEventListener('DOMContentLoaded', () => {

  global_place('supplier_province', 'supplier_municipality', 'supplier_barangay')

    $('.submit_supplier_form_button').on('click', function() {
        $('#formCreateSupplier').trigger('submit');
    });

   

    SupplierValidator.CreateSupplierValidation((e) => {
    e.preventDefault();
    console.log(SupplierValidator.serializeArrayToJson('#formCreateSupplier'));
    let data = {
        'supplier_name': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_name,
        'supplier_province': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_province,
        'supplier_municipality': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_municipality,
        'supplier_barangay': SupplierValidator.serializeArrayToJson('.formCreateSupplier').supplier_barangay,
    }
    SupplierClass.createSupplier(data, (e) => {
        window.location.reload(true);
    });
    });
})
