@extends('layout.app')

@section('main_content')
@include('admin.rfq.create')
<div class="ui top attached segment">
    <div class="ui two column grid">
        <div class="column">
            {{-- <button class="ui grey very tiny button">REQUEST FOR QUOTATION FORM</button> --}}
        </div>
        <div class="column" style="text-align: right">
            <button class="ui primary very tiny button submit_supplier_form_button">PROCEED</button>
        </div>
    </div>
</div>
<div class="ui form attached segment">
    <form class="ui form formCreateSupplier" action="#" id="formCreateSupplier" method="post">
        <div class="ui error message">
            {{--  --}}
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>SUPPLIER NAME</label>
                    <input type="text" name="supplier_name" placeholder="SUPPLIER NAME">
                </div>
                <div class="field">
                    <label>PROVINCE</label>
                    <div class="ui selection dropdown" id="supplier_province">
                        <input type="hidden" name="supplier_province">
                        <i class="dropdown icon"></i>
                        <div class="default text">PROVINCE</div>
                        <div class="menu">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <label>MUNICIPALITY</label>
                    <div class="ui selection dropdown" id="supplier_municipality">
                        <input type="hidden" name="supplier_municipality">
                        <i class="dropdown icon"></i>
                        <div class="default text">MUNICIPALITY</div>
                        <div class="menu">
                          
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>BARANGAY</label>
                    <div class="ui selection dropdown" id="supplier_barangay">
                        <input type="hidden" name="supplier_barangay">
                        <i class="dropdown icon"></i>
                        <div class="default text">BARANGAY</div>
                        <div class="menu">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="field">
            <div  class="two fields">
                <div class="field">
                    <input type="text" name="supplier_latitude" placeholder="LATITUDE" id="supplier_latitude" readonly>
                </div>
                <div class="field">
                    <input type="text" name="supplier_longitude" placeholder="LONGITUDE" id="supplier_longitude" readonly>
                </div>
                <div class="ui labeled button" tabindex="0" id="get_geolocation">
                    <div class="ui red button">
                      <i class="location arrow icon"></i> 
                    </div>
                    <a class="ui basic red left pointing label">
                     LOCATION
                    </a>
                  </div>
            </div>
        </div>
        <div class="ui modal geo_location_modal">
            <i class="close icon"></i>
            <div class="header">
              GOOGLE MAP
            </div>
            <h4 id="map-place"></h4>
            <span class="text-primary" id="map-latlng"></span>
            <div class="image content" id="geo_map_content" style="height: 50vh">
             
            </div>
            <div class="actions" id="button_map_confirm">
                <div class="ui positive left labeled icon button">
                <i class="checkmark icon"></i>
                CONFIRM GEO LOCATION
              </div>
            </div>        
        </div>        
    </form>
</div>
{{-- <div class="ui top attached segment">
    <div class="ui two column grid">
        <div class="column">
            <b class="modal-title">REQUEST FOR QUOTATION ITEMS LIST</b>
        </div>
        <div class="column" style="text-align:right">
            <button class="ui primary very tiny button add_item_button">ADD ITEM</button>
        </div>
    </div>
</div>
<div class="ui attached segment">
    @include('default.create-table', [
        'name' => 'quotation_items_table',
        'body' => 'quotation_table_body',
        'columns' => [
            'SEPCIFICATIONS',
            "BIDDER'S SPECIFICATIONS",
            "UNIT",
            'QUANTITY',
            'UNIT PRICE',
            'TOTAL PRICE',
            'ACTION',
        ]
    ])
</div> --}}
@endsection
@section('custom_js')
<script async src="{{env('MARCO_MAP_API')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
@vite(['resources/js/supplier/create.js'])

<script>

$('#get_geolocation').on('click', function() {
     $('.ui.modal.geo_location_modal').modal('show');
     initMap();
})

var dynamic_address = {
    'latitude' : 11.26888368831821,
    'longitude' : 124.93714892889646,
    'address' : '',
    'municipality' : '',
    'province' : ''
}

var map, marker
function initMap (){
        // console.log('POTA KA')
        var location = new google.maps.LatLng(11.26888368831821, 124.93714892889646)
        var mapProperty = {
            center : location,
            zoom : 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('geo_map_content'), mapProperty)
        marker = new google.maps.Marker({
            map : map,
            draggable : true,
            animation : google.maps.Animation.DROP,
            position : location,
            icon : "{{asset('map-marker-emb-green.png')}}"
        })

        // EVENTS FOR DRAGGING MAP MARKER
        google.maps.event.addListener(marker, 'dragend', function() {
            map.setCenter(marker.getPosition())
            geocodePosition(marker.getPosition())
            dynamic_address.latitude = marker.getPosition().lat()
            dynamic_address.longitude = marker.getPosition().lng()
            document.getElementById('map-latlng').innerHTML = dynamic_address.latitude + ', ' + dynamic_address.longitude 
            // console.log(dynamic_address)
        })
}

function geocodePosition(pos) {
    geocoder = new google.maps.Geocoder()
    geocoder.geocode({
        latLng : pos
    },
        function (res, state) {
            // console.log(res)
            if(state == google.maps.GeocoderStatus.OK) {
                // dynamic_address.address = res[0].address_components[0].longname + ', ' + res[0].address_components[1].longname + ', ' + 
                // document.getElementById('map-place').innerHTML = res[0].formatted_address
                if(res[1]) {
                    var prov = null, city = null, cityAlt = null, brgy = null, street = null
                    var c, lc, component
                    for (var r = 0, r1 = res.length; r < r1; r += 1) {
                        var result = res[r]

                        if(!city && result.types[0] === 'locality') {
                            for (c = 0, lc = result.address_components.length; c < lc; c += 1) {

                                component = result.address_components[c];
                                if (component.types[0] === 'locality') {
                                    city = component.long_name;
                                    break
                                }
                            }
                        }
                        if (!city && !cityAlt && result.types[0] === 'administrative_area_level_1') {

                            for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                                component = result.address_components[c];
                                if (component.types[0] === 'administrative_area_level_1') {
                                    cityAlt = component.long_name;
                                    console.log(cityAlt);

                                    break;
                                }
                            }
                        }
                        if (!prov && result.types[0] === 'administrative_area_level_2') {

                            prov = result.address_components[0].long_name;
                            // countryCode = result.address_components[0].short_name;
                        }
                        if (!brgy && result.types[0] === 'neighborhood') {

                            brgy = result.address_components[0].long_name
                            // console.log(Object.keys(result.address_components[1]).length)
                            for (x = 0; x < Object.keys(result.address_components[1]).length-1; x++) {
                                if(result.address_components[1].types[x] === 'sublocality') {
                                    brgy = brgy + ", " + result.address_components[1].long_name
                                    break;
                                }
                                // console.log(result.address_components[1].types)
                                console.log(brgy);
                            }
                        }
                        if (!street && result.types[0] === 'administrative_area_level_5') {

                            street = result.address_components[0].long_name
                            for (x = 0; x < Object.keys(result.address_components[1]).length-1; x++) {
                                if(result.address_components[1].types[x] === 'sublocality') {
                                    street = street + ", " + result.address_components[1].long_name
                                    break;
                                }
                            }
                        }
                        if (city && prov) {
                            break;
                        }
                    }

                    var map_place = document.getElementById('map-place')
                 
                    map_place.innerHTML = ''


                    if(brgy === null) {
                        map_place.innerHTML +=  city + ", " + prov
                        dynamic_address.address = street
                        dynamic_address.municipality = city
                        dynamic_address.province = prov
                    }else{
                        map_place.innerHTML += city + ", " + prov
                        dynamic_address.address = brgy
                        dynamic_address.municipality = city
                        dynamic_address.province = prov
                    }
                }
            }else{
                document.getElementById('map-place').innerHTML = '<span class="text-danger">Failed to determine location address!</span>'
            }
        })
}

var button_coords_confirm = document.getElementById('button_map_confirm')
button_coords_confirm.addEventListener('click', function() {
    console.log(dynamic_address);
    document.getElementById('supplier_latitude').value = dynamic_address.latitude
    document.getElementById('supplier_longitude').value = dynamic_address.longitude
    $('#modal-map').modal('toggle')
})



</script>
@endsection