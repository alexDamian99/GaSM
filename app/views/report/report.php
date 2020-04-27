<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../public/assets/css/report.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/template.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>GASM</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/css/ol.css" type="text/css" />
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/build/ol.js"></script>

    <script>
        function extend(elementId, arrowId) {
            var x = document.getElementById(elementId);
            var y = document.getElementById(arrowId);
            if (x.className == "active-form") {
                x.className = "";
                x.style.display = "none";
                y.className = "arrow down";
            } else {
                x.className += "active-form";
                x.style.display = "block";
                y.className = "arrow up";
            }
        }
    </script>
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>

    <main>
        <div id="map" class="map"></div>
        <script type="text/javascript">
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

            map.on('click', function(evt) {
                var loc = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326')
                var lon = loc[0];
                var lat = loc[1]
                alert(lat + "," + lon);
            });
        </script>

        <div class="report">
            <button id="report-btn" onclick="extend('report-form', 'arrow1')">
                <span>Do a new report</span>
                <i id="arrow1" class="arrow down"></i>
            </button>

            <form id="report-form" action="" method="POST">
                <label class="input-location">
                    <span>Location</span> <br />
                    <input class="input" type="text" name="location" placeholder="Lat, Lon" required />
                    <a href="#"><i class="fa fa-map-marker" style="font-size:24px"></i></a>
                </label>

                <br />
                <label>
                    <span>Type</span> <br />
                    <select name="type">
                        <option value="garbage-full">Garbage must be collected</option>
                        <option value="garbage-not-sorted">Waste sorting is not respected</option>
                    </select>
                </label>

                <br />

                <button type="submit" class="send" name="submit">Send</button>
            </form>
        </div>

        <div class="report">
            <button id="report-btn" onclick="extend('active-reports', 'arrow2')">
                <span>Active reports</span>
                <i id="arrow2" class="arrow down"></i>
            </button>

            <ul id="active-reports">
                <?php
                $doneBtn = false;
                if (isset($_SESSION['id_comp']))
                    $doneBtn = true;

                foreach ($data as $activeReport) {
                    if ($activeReport['type'] == 1) $type = 'Garbage must be collected';
                    else if ($activeReport['type'] == 2) $type = 'Waste sorting is not respected';
                    echo '<li class="active-report">
                            <h3>' . $type . '</h3>
                            <span>Location: <a href="#">' . $activeReport['location'] . '</a></span> <br />
                            <span>Date: ' . $activeReport['date'] . '</span> <br />
                            <span>Reported by: ' . $activeReport['user'] . '</span> <br />';
                    if ($doneBtn)
                        echo '<form action="" method="POST">
                                <input type="text" hidden value="' . $activeReport['id'] . '" name="report_id">
                                <button type="submit" class="send" name="done">Done</button>
                              </form>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>

</html>