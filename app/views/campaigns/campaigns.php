<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo getenv("path_to_public");?>/assets/css/campaigns.css">
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
        <div id="intro">
            <div>
                <p>Campaigns</p>
            </div>
        </div>
        <div class="campaigns">
            <div class="campaigns__search">
              <form action="" class="campaigns__search__bar search-bar">
                <label>
                  <span><img src="<?php echo getenv("path_to_public");?>/assets/images/search.svg" alt="search_icon"></span>
                  <input type="search" class="search-bar__input">
                </label>
                <button class="btn btn-green" type="submit">Search</button>
              </form>
            </div>
            <div class="campaigns__headers">   
              <div class="campaigns__headers__head">
                <img src="https://picsum.photos/300/200">
                <a href="#">
                  <p class="campaigns__headers__head__title">
                    Lorem ipsum sit dolor
                  </p>
                </a>
              </div>
              <div class="campaigns__headers__head">
                <img src="https://picsum.photos/300/200">
                <a href="#">
                  <p class="campaigns__headers__head__title">
                    Lorem ipsum sit dolor
                  </p>
                </a>
              </div>
              <div class="campaigns__headers__head">
                <img src="https://picsum.photos/300/200">
                <a href="#">
                  <p class="campaigns__headers__head__title">
                    Lorem ipsum sit dolor
                  </p>
                </a>
              </div>
              <div class="campaigns__headers__head">
                <img src="https://picsum.photos/300/200">
                <a href="#">
                  <p class="campaigns__headers__head__title">
                    Lorem ipsum sit dolor
                  </p>
                </a>
              </div>
              <div class="campaigns__headers__head">
                <img src="https://picsum.photos/300/200">
                <a href="#">
                  <p class="campaigns__headers__head__title">
                    Lorem ipsum sit dolor
                  </p>
                </a>
              </div>
              <div class="campaigns__headers__head">
                <img src="https://picsum.photos/300/200">
                <a href="#">
                  <p class="campaigns__headers__head__title">
                    Lorem ipsum sit dolor
                  </p>
                </a>
              </div>
            </div>
            <div class="campaigns__pagination">
              <a href="#"><</a>
              <a href="#" class="page-active">1</a>
              <a href="#">2</a>
              <a href="#">3</a>
              <a href="#">></a>
            </div>
        </div>
    </main>

	<?php include('../app/views/templates/footer.php'); ?>
</body>

</html>