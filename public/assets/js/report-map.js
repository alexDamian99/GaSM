var map = new ol.Map({
    target: "map",
    layers: [
        new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([27.57, 47.17]),
        zoom: 13
    })
});

var temp_marker = null;
var vectorSource = new ol.source.Vector();

function getLocation() {
    let locationField = document.getElementById('location-input');
    map.on('click', function(evt) {
        let loc = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326')
        let lon = loc[0].toFixed(6);
        let lat = loc[1].toFixed(6);

        // allow only one temp marker on map
        if (temp_marker != null)
            vectorSource.clear();
        temp_marker = addPointToMap(lat, lon);

        locationField.value = lat + "," + lon;
    });
}

function addPointToMap(lat, lon) {
    var marker = new ol.Feature({
        geometry: new ol.geom.Point(
            ol.proj.fromLonLat([lon, lat])
        ),
    });

    var markerStyle = new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.475, 30],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: '../public/assets/images/placeholder.png'
        })
    });
    marker.setStyle(markerStyle);

    vectorSource = new ol.source.Vector({
        features: [marker]
    });
    var markerVectorLayer = new ol.layer.Vector({
        source: vectorSource,
    });
    map.addLayer(markerVectorLayer);

    return marker;
}