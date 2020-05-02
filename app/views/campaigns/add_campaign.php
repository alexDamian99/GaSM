<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo getenv("path_to_public");?>/assets/css/add_campaign.css">
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
                <p>Create a campaign</p>
            </div>
        </div>
        <div class="add-campaign">
            <form id="campaign-details" action="" method="POST" enctype="multipart/form-data">
                <div>
                    <div class="col25"><label for="title">Title</label></div>
                    <div class="col75"><input type="text" id="title" required name="title"></div>
                </div>
                <div>
                    <div class="col25"><label for="description">Description</label></div>
                    <div class="col75"><textarea id="description" rows="10" required name="description"></textarea></div>
                </div>
                <div>
                    <div class="col25"><label for="location">Location</label></div>
                    <div class="col75"><input type="text" id="location" name="location"></div>
                </div>
                <div>
                    <div class="col25"><label for="date">Date</label></div>
                    <div class="col75"><input type="date" id="date" name="date"></div>
                </div>
                <div>
                    <div class="col75"><label for="campaign-banner">Click here to upload an image for your
                            campaign</label></div>
                    <div class="col75"><input type="file" id="campaign-banner" accept = "image/*" hidden name="banner"></div>
                </div>
                <div>
                    <input class="btn btn-green" type="submit" value="Submit" name="submit">
                </div>
            </form>
        </div>
    </main>
    
    <?php include('../app/views/templates/footer.php'); ?>
    
</body>

</html>