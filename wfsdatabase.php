<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet JS</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css">
    
    <style>
    html, body, #map {
        height: 100%;
        width: 100%;
        margin: 0px;
    }
    </style>
</head>
<body>
<script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src = "https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

    
    <div id="map"></div>

    <script>
        /* Initial Map */ 
        var map = L.map('map').setView([-6.85661, 107.41960], 11); //lat, long, zoom
        
        /* Tile Basemap */
        var basemap1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="DIVSIG UGM" target="_blank">DIVSIG UGM</a>'
        });
            var basemap2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',{
                attribution: 'Tiles &copy; Esri | <a href="Latihan WebGIS" target="_blank">DIVSIG UGM</a>'
        });	var basemap3 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri | <a href="Lathan WebGIS" target="_blank">DIVSIG UGM</a>' 
        });
            var basemap4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptile s.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        });
        basemap1.addTo(map);

        /* Penambahan poligon dari geoserver */
        var wfsgeoserver2 = L.geoJson(null, {        
                poligonToLayer: function (feature, latlng) {
                return L.polygon(latlng);
            },

            onEachFeature: function (feature, layer) {
                var content = "Kecamatan: " + feature.properties.wadmkc;
                layer.on({
                    click: function (e) {
                        wfsgeoserver2.bindPopup(content);
                    },
                    mouseover: function(e) {
                        wfsgeoserver2.bindTooltip(feature.properties.wadmkc).openTooltip;
                    },
                    mouseout: function(e) {
                        wfsgeoserver2.closePopup();
                    }
                });
            }
        });

    $.getJSON("wfsgeoserver1.php", function (data) {
        wfsgeoserver2.addData(data);
        map.addLayer(wfsgeoserver2);
    });

        // Mengatur koneksi ke database
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "admin";
        $dbname = "latihan";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        //Check Connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        //Menampilkan data longitude dan latitude dalam bentuk marker titik
        $sql = "SELECT * FROM wisata";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $lat = $row["latitude"];
                $long = $row["longitude"];
                $info = $row["nama_wisata"];
                echo "L.marker([$lat, $long]).addTo(map).bindPopup('$info');";
            } 
        }
        else {
            echo "0 results";
        }
            $conn->close();     
    ?>
    /* Control Layer */
    var baseMaps = {
            "OpenStreetMap": basemap1,
            "Esri World Street": basemap2,
            "Esri Imagery": basemap3,
            "Stadia Dark Mode": basemap4};
            L.control.layers(baseMaps).addTo(map);

    var overlayMaps = { 
        "Gedung B DIVSIG UGM": marker1, 
        "RS.Akademik UGM": marker2, 
    }; 
     
     L.control.layers(baseMaps, overlayMaps,  
     {collapsed: false}).addTo(map);
     
    </script>
</body>
</html>