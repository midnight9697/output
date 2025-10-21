import { MessageMod, confirmMod, createElement, global_place, progressControl, uploadControl } from "../app";
import { TBLButton } from "../table/buttons";
import Custom_table from "../table/custom_table";
import { SupplierClass } from "./supplier";
import { SupplierValidator } from "./validation";

let SPLTBL = {};
let selected_supplier = {};
document.addEventListener('DOMContentLoaded', () => {

  SPLTBL = new Custom_table('#supplier-inbox', false, true, false, false, './api/supplier/get_all_supplier');
  SPLTBL.dataSrc = (json) => {
      return json.data;
  }

  $('.submit_upload_button').on('click', () => {
      $('.formUpdateSupplier').trigger('submit');
  })

  SupplierValidator.UpdateSupplierValidation((e) => {
      e.preventDefault();
      let data = SupplierValidator.serializeArrayToJson('.formUpdateSupplier');
      console.log(data);
      data['projects'] = SupplierValidator.items;
      data['id'] = localStorage.getItem('supplier_id');
      SupplierClass.updateSupplier(data, () => {
          MessageMod.success("Saved Changes.", () => {
            MessageMod.hide();
            SPLTBL.table.ajax.reload();
          });
      });
  });

  global_place('supplier_province', 'supplier_municipality', 'supplier_barangay')

  SPLTBL.custom_buttons = (data) => {
    let div = document.createElement('div');
    TBLButton.data = data;
    TBLButton.updateAction =  () => {
      selected_supplier = data.id;
      $('#supplier-update-modal').modal('setting', 'closable', false).modal('show');
      $('#supplier_name').val(data.name)
      $('#supplier_province').dropdown('set selected', data.province);
      $('#supplier_municipality').dropdown('set selected', data.municipality);
      $('#supplier_barangay').dropdown('set selected', data.barangay);
      localStorage.setItem('supplier_id', data.id)
    }

    TBLButton.deleteAction = (e) => {
      confirmMod.load(() => {
        let spl_id = e.target.dataset.id;
        SupplierClass.remove(spl_id, (e) => {
          SPLTBL.table.ajax.reload();
          MessageMod.success("Successfully Deleted.");
        });
      }, "Do you want to delete this file ?");
    }
    TBLButton.loadButtons(div);
    return div;
  };
  
  SPLTBL.load([
    'name',
    'specificaddress',
    'created_at'
  ]);
  


});// DOMContentLoaded Endpoint


