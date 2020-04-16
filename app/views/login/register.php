<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/register.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GaSM | Register</title>

    <script>
        function showIdInput() {
            var radio = document.getElementById("radioCompany");
            var label = document.getElementById("company-id");
            if (radio.checked == true) {
                label.style.display = "flex";
            } else {
                label.style.display = "none";
            }
        }
    </script>

    <script>
        function checkPassStrength(password) {
            if (password.length == 0) {
                document.getElementById("pass-strength").innerHTML = "";
                return;
            } else {
                var weakRegex = new RegExp("^(?=.*[a-z])(?=.*[0-9])(?=.{6,})");
                var goodRegex1 = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})");
                var goodRegex2 = new RegExp("^(?=.*[a-z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{6,})");
                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

                var rez = "Very weak";
                if (weakRegex.test(password))
                    rez = "Weak";
                if (goodRegex1.test(password) || goodRegex2.test(password))
                    rez = "Good";
                if (strongRegex.test(password))
                    rez = "Strong";

                var doc = document.getElementById("pass-strength"); // get element where to write response
                doc.innerHTML = rez; // write response
                // add class based on response
                if (rez == "Very weak") doc.className = "very-weak";
                else if (rez == "Weak") doc.className = "weak";
                else if (rez == "Good") doc.className = "good";
                else if (rez == "Strong") doc.className = "strong";

                var info = "Password must be at least 6 characters long.";
                var info2 = "Password must contain at least a lower case letter.";
                var info3 = "Password must contain at least a number.";
                var info4 = "Password should contain at least an upper case letter.";
                var info5 = "Password should contain at least a special character.";

                doc.classList.add("tooltip"); // add class for tooltip
                var span = doc.appendChild(document.createElement('span')); // create tooltip pop-up
                span.className = 'tooltiptext'; // add class 
                var text = document.createTextNode(info + '\n' + info2 + '\n' + info3 + '\n' + info4 + '\n' + info5); // add inner text
                span.appendChild(text); // apend tooltip text
            }
        }
    </script>
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
                    <i class="fa fa-id-card"></i>
                    <input class="input" type="text" name="id" placeholder="ID" value="<?php if (isset($_COOKIE["temp_id"])) {
                                                                                            echo $_COOKIE["temp_id"];
                                                                                        } ?>">
                </label>

                <label class="credentials">
                    <i class="fa fa-user"></i>
                    <input class="input" type="text" name="name" placeholder="Name" required value="<?php if (isset($_COOKIE["temp_name"])) {
                                                                                                        echo $_COOKIE["temp_name"];
                                                                                                    } ?>">
                </label>

                <label class="credentials">
                    <i class="fa fa-envelope"></i>
                    <input class="input" type="email" name="email" placeholder="Email" required value="<?php if (isset($_COOKIE["temp_email"])) {
                                                                                                            echo $_COOKIE["temp_email"];
                                                                                                        } ?>">
                </label>

                <label class="credentials">
                    <i class="fa fa-user-plus"></i>
                    <input class="input" type="text" name="username" placeholder="Username" required value="<?php if (isset($_COOKIE["temp_username"])) {
                                                                                                                echo $_COOKIE["temp_username"];
                                                                                                            } ?>">
                </label>

                <label class="credentials">
                    <i class="fa fa-lock"></i>
                    <input class="input" type="password" name="password" placeholder="Password" onkeyup="checkPassStrength(this.value)" required>
                </label>

                <span id="pass-strength" class="tooltip"></span>
            </div>

            <button type="submit" name="submit">Register</button>

            <span class="display-errors"> <?php if (isset($_SESSION['error'])) {
                                                echo $_SESSION['error'];
                                                unset($_SESSION["error"]);
                                            } ?> </span>

            <div id="having-acc">
                <span>Already having an account?</span>
                <a href="./signin" class="link">Sign in</a>
            </div>

        </form>
    </main>

</html>