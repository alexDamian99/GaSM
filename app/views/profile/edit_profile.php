<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="assets/css/edit_profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>
    <main>
        <div class="profile_container">
            
            <form class="form" method="POST" enctype="multipart/form-data">
                <div class="profile_container__picture_container">
                    <!-- TODO tb sa pun dinamic poza asta in functie de utilizator -->
                    <img src= "<?php echo $_SESSION["profile_photo"] ?>" alt="profile_container__profile_picture" class="profile_container__profile_picture"> 
                    <div class="image_opacer">
                        <label>
                            <span>Upload photo</span>
                            <input type="file" name="input_file" id="input_file" value="default_photo.png" hidden>
                        </label>
                    </div>
                </div>
                <h1 class="text">
                    My profile details
                </h1>
                <label>
                    <span class="text">Name</span>
                    <input type="text" maxLength="64" name="input_name" id="input_name"  placeholder="New name">
                </label>
                <label>
                    <span class="text">Email</span>
                    <input type="email" maxLength="64" name="input_email" id="input_email" placeholder="New email">
                </label>
                <label>
                    <span class="text">Address</span>
                    <input type="text" name="input_address" id="input_address" placeholder="New address">
                </label>
                <button type="submit" name="submit_edit_profile" id="submit_edit_profile" class="button">Save</button>

                <span class="display-errors"> <?php if (isset($_SESSION['error'])) {
                                                echo $_SESSION['error'];
                                                unset($_SESSION["error"]);
                                            } ?> </span>
                <span class="display-success"> <?php if (isset($_SESSION['success'])) {
                                                echo $_SESSION['success'];
                                                unset($_SESSION["success"]);
                                            } ?> </span>
                 <span class="display-debug"> <?php if (isset($_SESSION['debug'])) {
                                                echo $_SESSION['debug'];
                                                unset($_SESSION["debug"]);
                                            } ?> </span>
                                            
            </form>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>

</html>