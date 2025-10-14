import places from './places.json' with { type: 'json' };
// $('#supplier_municipality')
//   .dropdown({
//     apiSettings: {
//       // this url just returns a list of tags (with API response expected above)
//       url: '//api.semantic-ui.com/tags/'
//     },
//     filterRemoteData: true
//   })
// ;

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
            console.log(brgys);

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

})
