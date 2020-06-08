<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo getenv("path_to_public"); ?>/assets/css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GASM</title>
    <meta name="description" content="Welcome to GaSM">


    <script src="<?= getenv("path_to_public") ?>/assets/js/index.js"></script>
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>

    <main>
        <section id="intro">
            <div>
                <h2>GaSM</h2>
                <span>
                Effective, efficient, friendly. <br> 
                The new way of helping the administration and every citizen manage the public trash in a better way.
                </span>
            </div>
        </section>


        <section class="facts">
            <div class="facts__fact">
                <img src="<?= getenv("path_to_public") ?>/assets/images/recycle_fact1.svg" alt="man_throwing_garbage">
                <div class="facts__fact__content">
                    <p>
                   Recycling or composting rates for three categories of materials, including paper and paperboard, yard trimmings, and food:
In 2017, the rate of paper and paperboard recycling was 65.9 percent (44.2 million tons), down slightly from 66.6 percent in 2015 (45.3 million tons), and up from 42.8 percent in 2000.
The rate of yard trimmings composted in 2017 was 69.4 percent (24.4 million tons), up from 61.3 percent (21.3 million tons) in 2015.
The rate of yard trimmings composted in 2000 was 51.7 percent.
In 2017, the rate of food and other composting was 6.3 percent (2.6 million tons), up from 5.3 percent in 2015 (2.1 million tons). The rate of food composting was 2.2 percent in the year 2000.
                    </p>
                </div>
            </div>
            <div class="facts__fact">
                <img src="<?= getenv("path_to_public") ?>/assets/images/eco_logo.svg" alt="recycle_logo">
                <div class="facts__fact__content">
                    <p>
                    In percentage of total MSW generation, recycling (including composting) did not exceed 15 percent until 1990. Growth in the recycling rate was significant over the next 15 years, spanning until 2005. The recycling rate grew more slowly over the last few years. The 2017 recycling rate was 35.2 percent.
The recycling (as a percentage of generation) of the below materials in MSW has mostly increased over the last 47 years.
                    </p>
                </div>
            </div>
        </section>

        <section class="report">
            <div class="report__writing">
                <img src="assets/images/warning.svg" alt="warningSign">
                <p>Do you wish to report something?</p>
            </div>
            <a class="btn btn-yellow" href="<?= getenv('path_to_public') ?>/report">Report here</a>
        </section>

        <section class="campaigns">
            <div class="campaigns__info-text">
                <p>CHECK OUT OUR</p></br>
                <p>CAMPAIGNS </p>
            </div>
            <div class="campaigns__headers">
                <?php foreach ($data as $campaign) { ?>
                <a href="<?php echo getenv('path_to_public') . '/campaigns/id/' . $campaign["id"]; ?>">
                    <div class="campaigns__headers__head"
                        style="background-image: url(https://proiect-tw-gasm.s3.eu-central-1.amazonaws.com/<?= $campaign['image_name'] ?>);">
                        <p><?= $campaign['title'] ?><p>
                    </div>
                </a>
                <?php } ?>
            </div>
            <a class="btn btn-green" href="<?= getenv("path_to_public") ?>/campaigns">See all campaigns</a>
        </section>

        <section class="trash-finder">
            <div class="trash-finder__logo">
                <p>SEARCH. FIND. RECYCLE.</p>
            </div>
            <div>
                <div class="trash-finder__result">
                    <img src="<?= getenv("path_to_public") ?>/assets/images/recycle_bin.svg" alt="recycle_bin">
                    <p>USE THE SPECIFIC RECYCLE BIN</p>
                </div>
            </div>

        </section>

    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>

</html>