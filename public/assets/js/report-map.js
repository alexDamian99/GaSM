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

var element_popup = document.getElementById('popup');

var popup = new ol.Overlay({
    element: element_popup,
    positioning: 'bottom-center',
    stopEvent: false,
    offset: [0, -35]
});
map.addOverlay(popup);

// display popup on click
map.on('click', function(evt) {
    var feature = map.forEachFeatureAtPixel(evt.pixel,
        function(feature) {
            return feature;
        });
    if (feature) {
        var coordinates = feature.getGeometry().getCoordinates();
        popup.setPosition(coordinates);
        element_popup.innerHTML = feature.get('type') + '<br><br>' + 'Report id: ' + feature.get('id');
        element_popup.style.display = 'flex';
    } else {
        element_popup.innerHTML = '';
        element_popup.style.display = 'none';
    }
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
        temp_marker = addPointToMap(lat, lon, null, 'default');

        locationField.value = lat + "," + lon;
    });
}

function addPointToMap(lat, lon, report_id, report_type) {
    var marker = new ol.Feature({
        geometry: new ol.geom.Point(
            ol.proj.fromLonLat([lon, lat])
        ),
        id: report_id,
        type: report_type
    });

    let placeholderType = '';
    switch (report_type) {
        case 'Garbage must be collected':
            placeholderType = 'report_1';
            break;
        case 'Waste sorting is not respected':
            placeholderType = 'report_2';
            break;
        default:
            placeholderType = report_type;
    }

    var markerStyle = new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.475, 30],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: 'assets/images/placeholders/placeholder_' + placeholderType + '.png'
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

function goToLocation(lat, lon) {
    map.getView().setCenter(ol.proj.transform([lon, lat], 'EPSG:4326', 'EPSG:3857'));
    map.getView().setZoom(15);
}