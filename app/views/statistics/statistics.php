<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL,fetch"></script>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
    <script type="text/javascript" src="assets/js/statistics.js" defer></script>
    <link rel="stylesheet" type="text/css" href="<?=getenv("path_to_public")?>/assets/css/statistics.css">
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>

    <main>
        <div class="stats_row">
            <div class="stats_row__chart" id="chart_div_month"></div>
        </div>

        <div class="stats_row">
            <div class="stats_row__chart" id="chart_div_year"></div>
        </div>

        <div class="stats_row">
            <div class="stats_row__chart" id="chart_div_day"></div>
        </div>

        <div class="stats_row">
            <div class="stats_row__chart" id="chart_div_cities"></div>
        </div>
        
        <div class="stats_row">
            <div class="stats_row__chart" id="chart_div_suburbs"></div>
        </div>

        <div class="export_div">
        <button class="btn btn-green" onclick="download_csv()">Export CSV</button>
        <button class="btn btn-green" id="download_pdf" >Export PDF</button>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>
</html>