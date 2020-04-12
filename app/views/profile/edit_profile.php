<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/css/index.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/edit_profile.css">
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
    <?php include('../templates/header.php'); ?>


    <main>
        <div id="profile_container">
            <div id="profile_container__picture_container">
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
                    <span class="text">Name*</span>
                    <input type="text" name="input_name" id="input_name" placeholder="Andrei Ianau">
                </label>
                <label>
                    <span class="text">Email*</span>
                    <input type="text" name="input_email" id="input_email" placeholder="andrei.ianauu@gmail.com">
                </label>
                <label>
                    <span class="text">Address*</span>
                    <textarea> Your address </textarea>
                </label>
                <label>
                    Payment method:
                    <select name="payment_method" id="payment_method">
                        <option value="">--</option>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                    </select>
                </label>
                <div id="button_gender">
                    <span>Gender</span>
                    <label>
                        <span>Male</span>
                        <input type="radio" name="button_gender" id="button_male">
                    </label>
                    <label>
                        <span>Female</span>
                        <input type="radio" name="button_gender" id="button_female">
                    </label>
                    <label>
                        <span>Rather not say</span>
                        <input type="radio" name="button_gender" id="button_female">
                    </label>
                </div>
                <button type="submit" class="button">Save</button>
            </form>
        </div>
    </main>

    <?php include('../templates/footer.php'); ?>
</body>

</html>