<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
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

    <link rel="stylesheet" href="https://unpkg.com/leaflet.zoomslider@0.7.1/src/L.Control.Zoomslider.css" />

    <link rel="stylesheet" href="maps.css"> 
</head>

<body>
    <!--To prevent user from using Ctrl shortcuts-->
<!--<body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;" >
    <?php
    include("developers.php");
    $fill = json_encode($fetchData);
    $size=sizeof($fetchData);
?>

     <div class="wrapper"> -->
    <div id="map"></div>
    <!--</div> -->
    <button id="button" onclick="reset_map();">resetmap </button>

    
    <div id="image">
        <!--<img src="location.png"> -->
        <img  onclick="navigator.geolocation.getCurrentPosition(getPosition);" src="location.png" id="image">  
        <!--<img  ontouchstart="navigator.geolocation.getCurrentPosition(getPosition);" > -->
    </div>
   
    <script>
        document.getElementById("image").ontouchstart = getPosition;
        /*
        var image=document.getElementById("image");
        const event = "ontouchstart" in window ? "touchstart" : "onclick";
        document.getElementById("image").addEventListener(event, () => getPosition()); */
    </script>
    
    <!--importing of map using leaflet library css-->
    <script
      src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
      integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
      crossorigin="" ></script>
      <!--importing of geosearch library css that helps to seacrh for places-->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    
    <script src="https://unpkg.com/leaflet.zoomslider@0.7.1/src/L.Control.Zoomslider.js" ></script>

    <script>
    //set coordinates of the map where it should center on

        var map_init = L.map('map',{
            zoomControl: false,
           //center: [2.0058346458568352, 37.29539165252644],
            zoom:8
        });
        var osm = L.tileLayer ('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo (map_init);

        map_init.addControl(new L.Control.Zoomslider());

        //map_init.locate({setView: true, maxZoom: 16});
            
        //to display East Africa on the map, the coordinates of the surrounding countries
        map_init.fitBounds([[8.033779620126401, 31.55864533680303],[8.816252603121956, 39.2930198315305],[2.9467560872051655, 45.42202981807704], [-6.311600830999214, 35.2267179841181], [2.9467560872051655, 45.42202981807704], [1.6734040326254147, 31.886874452303967]]);


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

        //document.getElementById("image").addEventListener("click touchstart", getPosition);
/*
document.getElementById("myP").addEventListener("touchstart", myFunction);

        function onLocationFound(position) {
            var radius = position.accuracy;

            L.marker(position.latlng).addTo(map_init)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();

            L.circle(position.latlng, radius).addTo(map_init);
        }

        //map_init.on('locationfound', onLocationFound);

        function onLocationError(e) {
            alert(position.message);
        }

        //map_init.on('locationerror', onLocationError); */


        var greenIcon = L.icon({
            iconUrl: 'locator4.png',
        });

        var here = <?php echo $fill; ?>;
        var size = <?php echo $size; ?>;
        let string = size;
        let num = parseInt(string);

        for (let i = 0; i < num; i++) {

            function myFunction(val) {
                var numb = val.match(/\d/g);
                numb = numb.join("");
                // alert (numb);​
                var destination = document.getElementById(numb).value.split(",");
                // alert(destination);

                window.location.href = "https://www.google.com/maps/dir/?api=1&destination=" + destination;
            // alert(val);


            };


            L.marker(here[i]['geocode'].split(","), {icon: greenIcon}).addTo(map_init)
            .bindTooltip(here[i]['name'])
            .bindPopup('<b> ' +here[i]['name']+': </b> <br/> \
                    <b> Mac Addr: </b>'+ here[i]['mac'] +'<br/> \
                    <b> <input type="text" id="'+i + '" value="'+ here[i]['geocode'] +'"/> <br/> \
                    <button id="b'+i+'" onClick="myFunction(this.id)"> Get Directions</button> + <br/> ')

        }
        map.fitBounds(group.getBounds());


        </script> 

        <script>

            function reset_map () {
                location.reload();
            }
        </script>
        <!--to prevent user from right clicking on the page-->
         <!--<html oncontextmenu="return false"> -->

    </body>
    <!--importing of disable-devtool library-->
    <!--
    <script disable-devtool-auto src='https://fastly.jsdelivr.net/npm/disable-devtool/disable-devtool.min.js'></script>
-->
</html> 
