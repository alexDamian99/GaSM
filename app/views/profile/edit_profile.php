<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../app/views/templates/head_header.php'); ?>
    <link rel="stylesheet" type="text/css" href="assets/css/edit_profile.css">
</head>

<body>
    <?php include('../app/views/templates/header.php'); ?>
    <main>
        <div id="profile_container">
            <div id="profile_container__picture_container">
                <!-- TODO tb sa pun dinamic poza asta in functie de utilizator -->
                <img src="/assets/images/profile_photo.jpg" alt="profile_container__profile_picture" id="profile_container__profile_picture"> 
                <div class="image_opacer">
                    <label>
                        <span>Upload photo</span>
                        <input type="file" name="file_input" id="file_input" hidden>
                    </label>
                </div>
            </div>
            <form action="submit" class="form">
                <h1 class="text">
                    My profile details
                </h1>
                <label>
                    <span class="text">Name</span>
                    <input type="text" name="input_name" id="input_name" placeholder="Andrei Ianau">
                </label>
                <label>
                    <span class="text">Email</span>
                    <input type="text" name="input_email" id="input_email" placeholder="andrei.ianauu@gmail.com">
                </label>
                <label>
                    <span class="text">Address</span>
                    <textarea> Your address </textarea>
                </label>
                <button type="submit" class="button">Save</button>
            </form>
        </div>
    </main>

    <?php include('../app/views/templates/footer.php'); ?>
</body>

</html>