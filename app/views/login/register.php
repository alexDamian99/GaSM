<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/register.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GaSM | Register</title>

    <script src="../public/assets/js/register.js"></script>
</head>

<body>
    <main>
        <form action="" method="POST">
            <a class="logo-container" href="./index">
                <img id="logo" src="../public/assets/images/navbar_logo.png" alt="logo">
            </a>

            <h1>Registration</h1>

            <div class="account-type">
                <input type="radio" id="radioPersonal" name="account" value="personal" onclick="showIdInput()" checked>
                <label for="radioPersonal" class="radio">Personal</label>
                <input type="radio" id="radioCompany" name="account" value="company" onclick="showIdInput()">
                <label for="radioCompany" class="radio">Company</label>
            </div>

            <div>
                <label class="credentials" id="company-id" style="display:none">
                    <i class="fas fa fa-id-card"></i>
                    <input class="input" type="text" name="id" placeholder="ID" value=<?php if (isset($_SESSION['temp-id_comp']))
                                                                                            echo $_SESSION['temp-id_comp'];
                                                                                        ?>>
                </label>

                <label class="credentials">
                    <i class="fas fa fa-user"></i>
                    <input class="input" type="text" name="name" placeholder="Name" required value=<?php if (isset($_SESSION['temp-name']))
                                                                                                        echo $_SESSION['temp-name'];
                                                                                                    ?>>
                </label>

                <label class="credentials">
                    <i class="fas fa fa-envelope"></i>
                    <input class="input" type="email" name="email" placeholder="Email" required onchange="checkEmail(this.value)" value=<?php if (isset($_SESSION['temp-email']))
                                                                                                                                            echo $_SESSION['temp-email'];
                                                                                                                                        ?>>
                    <i class="check <?php if (isset($_SESSION['temp-email-check'])) {
                                        if ($_SESSION['temp-email-check'] == true)
                                            echo 'fa fa-check green';
                                        else if ($_SESSION['temp-email-check'] == false)
                                            echo 'fa fa-times red';
                                    }
                                    ?>" id="check-email"></i>
                </label>

                <label class="credentials">
                    <i class="fas fa fa-user-plus"></i>
                    <input class="input" type="text" name="username" placeholder="Username" required onchange="checkUsername(this.value)" value=<?php if (isset($_SESSION['temp-username']))
                                                                                                                                                    echo $_SESSION['temp-username'];
                                                                                                                                                ?>>
                    <i class="check <?php
                                    if (isset($_SESSION['temp-username-check'])) {
                                        if ($_SESSION['temp-username-check'] == true)
                                            echo 'fa fa-check green';
                                        else if ($_SESSION['temp-username-check'] == false)
                                            echo 'fa fa-times red';
                                    }
                                    ?>" id="check-username"></i>
                </label>

                <label class="credentials">
                    <i class="fas fa fa-lock"></i>
                    <input class="input" type="password" name="password" placeholder="Password" onkeyup="checkPassStrength(this.value)" required>
                </label>

                <span id="pass-strength" class="tooltip"></span>
            </div>

            <button type="submit" name="submit">Register</button>

            <div id="having-acc">
                <span>Already having an account?</span>
                <a href="./signin" class="link">Sign in</a>
            </div>

        </form>
    </main>

</html>