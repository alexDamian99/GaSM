<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js" defer></script>
    <script type="text/javascript" src="assets/js/statistics.js" defer></script>
    <link rel="stylesheet" type="text/css" href="<?=getenv("path_to_public")?>/assets/css/statistics.css">
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>

    <main>
        <div class="stats_row">
            <span>Uite ce statistica frumoasa 1</span>
            <div class="stats_row__chart" id="piechart"></div>
        </div>
        <div class="stats_row">
            <span>Uite ce statistica frumoasa 1</span>
            <div class="stats_row__chart" id="chart_div"></div>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>
</html>