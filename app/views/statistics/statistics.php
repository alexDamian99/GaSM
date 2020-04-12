<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/statistics.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/assets/js/statistics.js"></script>
    <title>GASM</title>
</head>

<body>
    <?php include('../templates/header.php'); ?>

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

    <?php include('../templates/header.php'); ?>
</body>

</html>