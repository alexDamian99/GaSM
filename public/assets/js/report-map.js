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

function getLocation() {
    let locationField = document.getElementById('location-input');
    map.on('click', function(evt) {
        let loc = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326')
        let lon = loc[0].toFixed(6);
        let lat = loc[1].toFixed(6);
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
            anchor: [0.5, 46],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: 'https://openlayers.org/en/v3.20.1/examples/data/icon.png'
        })
    });
    marker.setStyle(markerStyle);

    var vectorSource = new ol.source.Vector({
        features: [marker]
    });
    var markerVectorLayer = new ol.layer.Vector({
        source: vectorSource,
    });
    map.addLayer(markerVectorLayer);
}