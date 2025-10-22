@extends('layout.app')

@section('main_content')
<style>
    body {
    background: rgb(243, 244, 245);
    height: 100%;
    color: rgb(100, 108, 127);
    line-height: 1.4rem;
    font-family: Roboto, "Open Sans", sans-serif;
    font-size: 20px;
    font-weight: 300;
    text-rendering: optimizeLegibility;
}

h1 { text-align: center; }

.dropzone {
    background: white;
    border-radius: 5px;
    border: 2px dashed rgb(0, 135, 247);
    border-image: none;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

#total-progress {
        height: 20px;
        background-color: #f3f3f3;
        border-radius: 5px;
        margin-top: 10px;
        overflow: hidden;
    }

    #total-progress-bar {
        height: 100%;
        background-color: #4CAF50;
        transition: width 0.3s ease-in-out;
    }
</style>
@php
    $lastActivity = strtotime(date('Y-m-d h:m a'));

    // Get the session lifetime in minutes from the configuration
    $sessionLifetimeMinutes = Config::get('session.lifetime');
    
    // Calculate the expiration timestamp
    $expirationTimestamp = $lastActivity + ($sessionLifetimeMinutes * 60);
    
    // Calculate the remaining minutes
    $remainingMinutes = floor(($expirationTimestamp - time()) / 60);
    echo "Remaining session time: " . $remainingMinutes . " minutes.";
@endphp
<div class="ui grid stackable padded">
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">{{$count_user}}</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Total No. of Users
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">{{$count_supplier}}</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Total Suppliers
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>

    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header">{{$count_pr}}</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Total Purchase Request
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
    
    <div class="four wide computer eight wide tablet sixteen wide mobile column">
        <div class="ui fluid card">
            <div class="content">
                <div class="ui right floated header">
                    <div class="file alternate icon"></div>
                </div>
                <div class="header">
                    <div class="red header rfq_counter">{{$count_rfq}}</div>
                </div>
                <div class="meta">Files</div>
                <div class="description">
                    Total Request for Quotation
                </div>
            </div>
            <div class="extra content">
                <a href="#" class="ui fluid button red">More Info</a>
            </div>
        </div>
    </div>
</div>


<div class="ui grid stackable padded">
        <div class="ui fluid card">
           <div class="content">
                <div id="dashmap" style="height:50vh; width:100%">
                    <!-- THIS SHIT RIGHT HERE IS WHERE THE MAP MAGICALLY APPEARS OUT OF NOWHERE -->
                </div>
            </div>
        </div>
</div>

@endsection
@section('custom_js')
    @vite(['resources/js/home.js'])
    <script async src="{{env('MARCO_MAP_API')}}"></script>
    <script>
      var map, marker
      var markers = []
      let infoWindow
      const mapIcon = {}
  document.addEventListener('DOMContentLoaded', () => {
    initMap();
  });
  function initMap() {
  
        // INITIALIZE THE MAP
        mapIcon.url = '{{ asset('mapicon.png') }}';
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


  </script>
@endsection