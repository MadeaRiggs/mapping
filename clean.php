<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Real Time Tracker</title>
    <!--importing of map using leaflet library css-->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""
    />
    <!--importing of geosearch library css that helps to seacrh for places-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="maps.css"> 
</head>

<body>
    <?php
    include("developers.php");
    $fill = json_encode($fetchData);
    $size=sizeof($fetchData);
?>
        
    <label>Zoom Slider</label><br>
    <input type="range" min="1" max="20" value="8" oninput="adjustZoom(this.value)">


    <div id="map"></div>
    <div id="image">
        <img  onclick="navigator.geolocation.getCurrentPosition(getPosition);" src="location.png"> 
    </div>
    
    <!--importing of map using leaflet library css-->
    <script
      src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
      integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
      crossorigin="" ></script>
      <!--importing of geosearch library css that helps to seacrh for places-->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    

    <script>
    //set coordinates of the map where it should center on
        var map_init = L.map('map',{
            center: [0.5496163356389989, 37.67061432828364],
            zoom:8
        });
        var osm = L.tileLayer ('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo (map_init);

        var zoomVal;
        function adjustZoom(params) {
            map_init.setZoom(params)
        }
        
        //Geocoding is the process of converting addresses like “1600 Amphitheatre Parkway into geographic coordinates latitude 37.423021 and longitude -122.083739
        //but here we are doing Reverse Geocoding
        L.Control.geocoder().addTo(map_init);

        //navigator.geolocation is a global object that returns a geolocation object by the browser that gives web content access to the location of the device. Most browsers are geolocation enabled.
        if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!");
        } //else {
            //setInterval(() => {
            //navigator.geolocation.getCurrentPosition(getPosition);
            //}, 60000);
        //}

        var marker, circle, lat, long, accuracy;

        function getPosition(position) {
        // console.log(position)
        lat = position.coords.latitude;
        long = position.coords.longitude;
        accuracy = position.coords.accuracy;

        if (marker) {
            map_init.removeLayer(marker);
        }

        if (circle) {
            map_init.removeLayer(circle);
        }

        marker = L.marker([lat, long]);
        circle = L.circle([lat, long], { radius: accuracy });

        //.featureGroup creates a Leaflet Feature Group that adds its child layers into a parent group when added to a map
        var featureGroup = L.featureGroup([marker, circle]).addTo(map_init);

        map_init.fitBounds(featureGroup.getBounds());

        console.log("Your coordinate is: Lat: " +lat +" Long: " +long +" Accuracy: " +accuracy);

        
        };
    var greenIcon = L.icon({
    iconUrl: 'locator4.png',
    });
    var here = <?php echo $fill; ?>;
        var size = <?php echo $size; ?>;
        let string = size;
        let num = parseInt(string);
    // var obj = "hello";
    
    for (let i = 0; i < num; i++) {

            function myFunction() {
                for (let j=0; j < num; j++) {
                    if (j==0) {
                        var destination=here[0]['geocode'].split(",");
                }
                    else {
                        var destination=here[1]['geocode'].split(",");
                }
                }
                
                
                window.location.href = "https://www.google.com/maps/dir/?api=1&destination=" + destination;

            };
     
        
        L.marker(here[i]['geocode'].split(","), {icon: greenIcon}).addTo(map_init)
         .bindTooltip(here[i]['name'])
         .bindPopup('<b> ' +here[i]['name']+': </b> <br/> \
                     <b> Mac Addr: </b>'+ here[i]['mac'] +'<br/> \
                     <b> <input type="text" id="'+i + '" value="'+ here[i]['geocode'] +'"/> <br/> \
                     <button onClick="myFunction()"> Get Directions</button> + <br/> ')
	
}
        map.fitBounds(group.getBounds());


        </script>             
    </body>
</html> 
