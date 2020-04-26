<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo getenv("path_to_public");?>/assets/css/campaign.css">

    
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
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v6.0&appId=1716299771943026&autoLogAppEvents=1"></script>

    
    <?php include('../app/views/templates/header.php'); ?>
    <main>
        <div id="intro">
            <div>
                <p>Titlu campanie</p>
            </div>
        </div>
        

        <div class="campaign">
            <div class="campaign__content">
                <img src="https://picsum.photos/500/200">
                <div class="campaign__content__description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <ul class="campaign__details">
                <li><img src="https://picsum.photos/128/128" alt="profile_picture"></li>
                <li>By Ion</li>
                <li>Event date(optional): 20/12/2020</li>
                <li>
                    <p>Help us make the world a better place</p>
                    <ul class="social-share">
                        <li><a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"
                                data-show-count="false">Tweet</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </li>

                        <li>
                            <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                                data-layout="button" data-size="small"><a target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                                    class="fb-xfbml-parse-ignore">Share</a></div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>

</html>