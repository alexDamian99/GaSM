<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script type="text/javascript" src="assets/js/statistics.js" defer></script>
    <link rel="stylesheet" type="text/css" href="assets/css/statistics.css">
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>

    <main>
        <div class="stats_row">
            <span>Uite ce statistica frumoasa 1</span>
            <div class="stats_row__chart" id="chart_div_month"></div>
        </div>

        <div class="stats_row">
            <span>Uite ce statistica frumoasa 1</span>
            <div class="stats_row__chart" id="chart_div_year"></div>
        </div>

        <div class="stats_row">
            <span>Uite ce statistica frumoasa 1</span>
            <div class="stats_row__chart" id="chart_div_day"></div>
        </div>

        <div class="export_div">
        <button class="btn btn-green" id="download_csv" onclick="download_csv()">Export CSV</button>
        <button class="btn btn-green" id="download_pdf" >Export PDF</button>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>
</html>