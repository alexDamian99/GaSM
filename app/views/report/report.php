<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="<?= getenv("path_to_public") ?>/assets/css/report.css">
    <link rel="stylesheet" type="text/css" href="<?= getenv("path_to_public") ?>/assets/css/template.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>GASM</title>
    <meta name="description" content="Do a new report">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/css/ol.css"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.2.1/build/ol.js"></script>

    <script src="<?= getenv("path_to_public") ?>/assets/js/report.js"></script>

    <script>
    function myFunction() {
        var x = document.getElementById("mobile-navbar");
        if (x.className === "responsive-navbar") {
            x.className = "";
        } else {
            x.className += "responsive-navbar";
        }
    }
    </script>
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>

    <main>
        <div id="map" class="map">
            <div id="popup"></div>
        </div>
        <script src="<?= getenv("path_to_public") ?>/assets/js/report-map.js"></script>

        <?php
        if (isset($_SESSION['id_comp']) && $data['verified'] == 1) {
            echo
                '<div class="report">
                <button id="report-btn" onclick="extend(\'recycle-form\', \'arrow3\')">
                    <span>Mark a new recycle point</span>
                    <i id="arrow3" class="arrow down"></i>
                </button>

                <div id="recycle-form">
                    <label class="input-location">
                        <span>Location</span> <br />
                        <input id="location-input-recycling" class="input" type="text" name="location-recycle" placeholder="Lat, Lon"
                            required />
                        <a href="#" onclick="getLocation(\'recycling\')"><i class="fa fa-map-marker" style="font-size:24px"></i></a>
                    </label>

                    <br />
                    <label>
                        <span>Garbage type</span> <br />
                        <select id="type-recycle" name="type-recycle">
                            <option value="organic">Organic</option>
                            <option value="paper">Paper</option>
                            <option value="plastic">Plastic</option>
                            <option value="glass">Glass</option>
                            <option value="metal">Metal</option>
                            <option value="mixed">Mixed</option>
                        </select>
                    </label>';

            echo '<br />
                <button onClick="addNewRecyclePoint()" class="send" name="submit-recycle">Send</button>
                </div>
                </div>';
        }
        foreach ($data['recycle_points'] as $recyclePoint)
            echo '<script>addPointToMap(' . $recyclePoint['location'] . ', ' . $recyclePoint['id'] . ', "' . $recyclePoint['type'] . '")</script>';
        ?>

        <div class="report">
            <button id="report-btn" onclick="extend('report-form', 'arrow1')">
                <span>Do a new report</span>
                <i id="arrow1" class="arrow down"></i>
            </button>

            <div id="report-form">
                <label class="input-location">
                    <span>Location</span> <br />
                    <input id="location-input-report" class="input" type="text" name="location-report"
                        placeholder="Lat, Lon" required />
                    <a href="#" onclick="getLocation('report')"><i class="fa fa-map-marker"
                            style="font-size:24px"></i></a>
                </label>

                <br />
                <label>
                    <span>Type</span> <br />
                    <select id="type-report" name="type-report">
                        <option value="garbage-full">Garbage must be collected</option>
                        <option value="garbage-not-sorted">Waste sorting is not respected</option>
                    </select>
                </label>

                <br />

                <button onclick="addNewReport()" class="send" name="submit-report">Send</button>
            </div>
        </div>

        <div class="report">
            <button id="report-btn" onclick="extend('active-reports', 'arrow2')">
                <span>Active reports</span>
                <i id="arrow2" class="arrow down"></i>
            </button>

            <ul id="active-reports">
                <?php
                $like_permission = '';
                $dislike_permission = '';
                if (isset($_SESSION['username'])) {
                    $like_permission = 'onclick="newLike(this)"';
                    $dislike_permission = 'onclick="newDislike(this)"';
                }

                foreach ($data['active_reports'] as $activeReport) {
                    // get report's type
                    $type = '';
                    if ($activeReport['type'] == 1)
                        $type = 'Garbage must be collected';
                    else if ($activeReport['type'] == 2)
                        $type = 'Waste sorting is not respected';

                    // check if current report is liked/disliked by user
                    $btn_like_class = 'not-clicked';
                    if (in_array($activeReport['id'], $data['liked_reports']))
                        $btn_like_class = 'clicked';
                    $btn_dislike_class = 'not-clicked';
                    if (in_array($activeReport['id'], $data['disliked_reports']))
                        $btn_dislike_class = 'clicked';


                    // get total likes/dislikes
                    $likes = isset($data['likes'][$activeReport['id']]) ? $data['likes'][$activeReport['id']] : 0;
                    $dislikes = isset($data['dislikes'][$activeReport['id']]) ? $data['dislikes'][$activeReport['id']] : 0;

                    echo '<li class="active-report">
                                <h3>' . $type . '</h3>
                                <span onclick="goToLocation(' . $activeReport['location'] . ')">Location: <a href="#">' . $activeReport['location'] . '</a></span> <br />
                                <script>addPointToMap(' . $activeReport['location'] . ', ' . $activeReport['id'] . ', "' . $type . '")</script>
                                <span>Date: ' . $activeReport['date'] . '</span> <br />
                                <span>Reported by: ' . $activeReport['user'] . '</span> <br />
                                <div class="kudos">
                                    <i id="like-btn" class="fa fa-thumbs-up ' . $btn_like_class . '" 
                                        data-id="' . $activeReport['id'] . '" ' . $like_permission . '>' . $likes . '</i> 
                                    <i id="dislike-btn" class="fa fa-thumbs-down ' . $btn_dislike_class . '" 
                                        data-id="' . $activeReport['id'] . '" ' . $dislike_permission . '>' . $dislikes . '</i>
                                </div>';
                    if (isset($_SESSION['id_comp']) && $data['verified'] == 1)
                        echo '<div>
                                    <input type="text" hidden value="' . $activeReport['id'] . '" name="report_id">
                                    <button onClick="deleteReport(' . $activeReport['id'] . ')" class="send" name="done">Done</button>
                                </div>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>

</html>