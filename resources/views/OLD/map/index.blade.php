@extends('testLayout')

@section('content')

    

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 600px;
        /* The height is 600 pixels */
        width: 900px;
        /* The width is the width of the web page */
        margin-top: 50px;
        text-align: center;
        margin-left: 290px;
      }
      h1 {
      color: #F8F8FF;}
      
    
    </style>

     @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif

 
  <div>
    <script>
      // Initialize and add the map
      let map, infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 41.8763467 , lng: -87.6273056 },
    zoom: 6,
  });
  //The marker
  
  infoWindow = new google.maps.InfoWindow();
  const locationButton = document.createElement("button");
  locationButton.textContent = "Pan to Current Location";
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
          infoWindow.setPosition(pos);
          infoWindow.setContent("Location found.");
          infoWindow.open(map);
          map.setCenter(pos);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
}


function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}

    </script>
    </div>
   
   
    
    <h1 style="text-align:center;">Demo</h1>
      
    
    
    <div id="map"></div>

   
    <!-- <script async="" defer=""
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALKCf1pUy49HFcl_4ycvc3QZqRRvibodI&callback=initMap&libraries=&v=weekly"
    ></script> -->
    
 
@endsection
