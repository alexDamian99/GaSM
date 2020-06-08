<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="<?=getenv("path_to_public")?>/assets/css/profile.css">
    <script type="text/javascript" src="<?=getenv("path_to_public")?>/assets/js/profile.js"></script>
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>
    
    <main>
        <div class="profile_container">
            <div class="profile_container__picture_container">
                <img src="<?= $_SESSION["profile_photo"] ?>" alt="profile_container__profile_picture" class="profile_container__profile_picture">
                <div class="image_opacer">
                    <a href="./edit_profile">Edit profile</a>
                </div>
            </div>

            <ul class="profile_container__menu">
                <li><button class="button" onclick="showReports()" >My reports </button></li>
                <li><button class="button" onclick="showEvents()"> Events </button></li>
            </ul>

            <ul class="profile_container__feed">
                <div  id="profile_container__feed__reports">
                    <?php 
                        foreach ($data[0] as $activeReport){
                            echo '<li>';
                                echo `<a href="/report/$activeReport['id']"> Report </a>`;
                            echo '</li>';
                        }
                    ?>
                </div>

                <div  id="profile_container__feed__events">
                    <?php 
                        foreach ($data[1] as $activeEvent){
                            echo '<li>';
                                echo `<h3> $activeEvent['title'] </h3>`;
                                echo `<span> $activeEvent['description'] </span>`;
                                echo `<a href="/campaigns/id/$activeEvent['id']"> Campaign link </a>`;
                            echo '</li>';
                        }
                    ?>
                </div>
            </ul>
        </div>
        <?php 
        if (isset($_SESSION['debug'])){
            echo $_SESSION['debug'];
            unset($_SESSION['debug']);
        }
        ?>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
    

</body>

</html>