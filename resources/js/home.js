import { pageLoadMod } from "./app";
import { rfqClass } from "./rfq/rfq";
var map, marker
var markers = []
let infoWindow
const mapIcon = {}

document.addEventListener('DOMContentLoaded', () => {
   // let rfq_counter = $('.rfq_counter');
  
   // setInterval(() => {
   //    rfqCounter();
   // }, 1000);
   // pageLoadMod.destroy();
   initMap();
});
 
function initMap() {
   // INITIALIZE THE MAP
   mapIcon.url = localStorage.getItem('asset');
   mapIcon.scaledSize = new google.maps.Size(15, 15)
   var location = new google.maps.LatLng(11.26888368831821, 124.93714892889646)
   var mapProperty = {
       center : location,
       zoom : 8,
       mapTypeId: google.maps.MapTypeId.HYBRID
   }
   map = new google.maps.Map(document.getElementById('dashmap'), mapProperty)
   // FETCH DATA TO POPULATE MAP
   let data = {
       'type' : 'supplier'
   }
   setMarkers(data)
}
function setMarkers(data) {
 deleteMarkers()
 infoWindow = new google.maps.InfoWindow({})
 map.setCenter(new google.maps.LatLng(11.26888368831821, 124.93714892889646))    // DEFAULT GEOLOCATION FOR REGION VIII
 map.setZoom(8)
 let xhr = new XMLHttpRequest()
 xhr.open('post', 'map_loader')
 xhr.setRequestHeader('Content-Type', 'application/json')
 xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

 xhr.onload = function() {
     let response = JSON.parse(xhr.responseText)
     for (var x=0; x<response.length; x++) {
         marker = new google.maps.Marker({
             map : map,
             position : new google.maps.LatLng(response[x].latitude, response[x].longitude),
             icon : mapIcon
         })
         markers.push(marker)
         google.maps.event.addListener(marker, 'click', (function(marker, x) {
             return function () {
                 var textContent = '<b><p style="text-align:center">SUPPLIER DETAILS</p></b><table class="ui fixed table" style="margin-bottom:15px">' +
                                     '<tr>' +
                                     '<td><b>SUPPLIER NAME:</b></td>' +
                                     '<td>' + response[x].name + '</td>' +
                                     '</tr>' +
                                     '<tr>' +
                                     '<td><b>ADDRESS:</b></td>' +
                                     '<td>' + response[x].barangay + ', ' +  response[x].municipality + ', ' + response[x].province + '</td>' +
                                     '</tr>' +
                                     '</table>'
                infoWindow.setContent(textContent)
                infoWindow.open(map, marker)
             }
         })(marker, x))
     }
     // set map
     setMapOnAll(map)
 }
 xhr.send(JSON.stringify(data))
}
function deleteMarkers() {
setMapOnAll(null)
markers = []    //clears array
}

// create the setMapOnAll function
function setMapOnAll(map) {
   // loop thru each marker on markers array
   for (var i=0; i< markers.length; i++) {
       markers[i].setMap(map)
   }
}