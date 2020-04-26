<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="assets/css/profile.css">
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>
    
    <main>
        <div class="profile_container">
            <div class="profile_container__picture_container">
                <img src="<?php echo $_SESSION["profile_photo"] ?>" alt="profile_container__profile_picture" class="profile_container__profile_picture">
                <div class="image_opacer">
                    <a href="/gasm/public/profile/edit_profile.php">Edit profile</a>
                </div>
            </div>

            <ul class="profile_container__menu">
                <li><button class="button">My reports </button></li>
                <li><button class="button"> Events </button></li>
            </ul>

            <ul class="profile_container__feed">

                <li>
                    Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
                <li>
                    Lorem ipsum Lorem ipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaaipsumdsadsaaaaaaaaaaaaaaaaaaaaaa
                </li>
            </ul>

        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
    

</body>

</html>