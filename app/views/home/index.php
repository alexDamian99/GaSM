<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo getenv("path_to_public");?>/assets/css/index.css">
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
    <title>GASM</title>
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>

    <main>
        <section id="intro">
            <div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <button class="btn btn-green">Learn more</button>
            </div>
        </section>
    
    
        <section class="facts">
            <div class="facts__fact">
                <img src="../public/assets/images/recycle_fact1.svg" alt="man_throwing_garbage">
                <div class="facts__fact__content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
            <div class="facts__fact">
                <img src="../public/assets/images/eco_logo.svg" alt="recycle_logo">
                <div class="facts__fact__content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
        </section>

        <section class="report">
            <div class="report__writing">
                <img src ="assets/images/warning.svg">
                <p>Do you wish to report something?</p>
            </div>
            <button class="btn btn-yellow">Report here</button>
        </section>

        <section class="campaigns">
            <div class="campaigns__info-text">
            <p>CHECK OUT OUR</p></br>
            <p>CAMPAIGNS </p>
            </div>
            <div class="campaigns__headers">
                <a href="#">
                <div class="campaigns__headers__head">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor est eu aliquam porttitor.<p>
                </div>
                </a>
                <a href="#">
                <div class="campaigns__headers__head">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor est eu aliquam porttitor.<p>
                </div>
                </a>
                <a href="#">
                <div class="campaigns__headers__head">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris auctor est eu aliquam porttitor.<p>
                </div>
                </a>
            </div>
            <a class="btn btn-green" href="">See all campaigns</a>
        </section>

        <section class="trash-finder">
            <div class="trash-finder__logo">
                <p>SEARCH. FIND. RECYCLE.</p>
            </div>
            <div>
                <div class="trash-finder__search">
                    <form action="" class="search-bar">
                        <label>
                            <span>I want to recycle</span>
                            <input type="text" class="search-bar__input">
                        </label>
                        <button class="btn btn-green" type="submit">Where should I throw it?</button>
                    </form>
                </div>
                <div class="trash-finder__result">
                    <img src="assets/images/recycle_bin.svg" alt="recycle_bin">
                    <p>USE THE GREEN RECYCLE BIN</p>
                </div>
            </div>
            
        </section>
        
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>

</html>