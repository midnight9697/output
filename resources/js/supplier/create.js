import places from './places.json' with { type: 'json' };
import { MessageMod } from "../app";
import { SupplierValidation } from "../supplier/validation";
import { TBLButton } from "../table/buttons";
import { SupplementalControl } from "./supplemental";
import { SupplierSpecsValidation, SupplierValidator } from "./validation";

document.addEventListener('DOMContentLoaded', () => {
  let provinces = places['08']['province_list'];

  // select province
  $('#supplier_province')
  .dropdown({
    values: Object.keys(provinces).map(function(prov) {
      return {
        name: prov,
        value: prov,
      }
    }),
    onChange: function(value, text, selectedItem) {
      const municipalities = provinces[value]['municipality_list'];

        // select municipality
        $('#supplier_municipality').dropdown({
          values: Object.keys(municipalities).map(function(mun) {
            return {
              name: Object.keys(municipalities[mun])[0],
              value: Object.keys(municipalities[mun])[0],
            };
          }),
          onChange: function(value,text, selectedItem){
            let tmp_municipality = municipalities.find(municipality => Object.keys(municipality)[0] == value);
            let brgys = tmp_municipality[value]['barangay_list'];
 
            $('#supplier_brgy').dropdown({
              values: brgys.map(function(brgy) {
                return {
                  name: brgy,
                  value: brgy,
                };
              }),
              onChange: function(value,text, selectedItem){
                // Logic
              },
              clearable: true
            });
          },
          clearable: true
        });
   
    }
  });

  let formClass = ".formCreateSupplementalSpec";
  let formArray = SupplierValidation.serializeArrayToJson(formClass);

    $('.submit_supplier_form_button').on('click', function() {
        $('#formCreateSupplier').trigger('submit');
    });

    SupplierValidator.CreateSupplierValidation((e) => {
      e.preventDefault();
      let data = SupplierValidation.serializeArrayToJson('.formCreateSupplier');
      data['projects'] = SupplierValidator.items;
      SupplierControl.createSupplier(data, () => {
          MessageMod.success("Supplier successfully created.", () => {
              window.location = "/Supplier";
          });
      });
  });
})
