<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/signin.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GaSM | SignIn</title>
</head>

<body>
    <main>
        <form action="" method="POST">
            <a class="logo-container" href="./index">
                <img id="logo" src="../public/assets/images/navbar_logo.png" alt="logo">
            </a>

            <h1>Sign in</h1>

            <label class="input-credentials">
                <span>Username</span> <br>
                <input class="input" type="text" name="username" value="<?php
                                                                        if (isset($_SESSION["temp-username-login"])) {
                                                                            echo $_SESSION["temp-username-login"];
                                                                        }
                                                                        else if (isset($_COOKIE["username"])) {
                                                                            echo $_COOKIE["username"];
                                                                        }
                                                                        ?>" placeholder="&#xF007; Type your username" required>
            </label>

            <label class="input-credentials">
                <span>Password</span> <br>
                <input class="input" type="password" name="password" placeholder="&#xF023; Type your password" required>
            </label>

            <label id="remember-me">
                <input type="checkbox" name="remember" <?php if (isset($_COOKIE["username"])) { ?> checked <?php } ?>>
                <span>Remember me</span>
            </label>

            <a href="./forgotPass" id="forgot-pass" name="forgot" class="link">Forgot password?</a>

            <button type="submit" name="submit">Sign in</button>

            <span class="display-errors"> <?php if (isset($_SESSION['error'])) {
                                                echo $_SESSION['error'];
                                                unset($_SESSION["error"]);
                                            } ?> </span>

            <div id="separator">
                <span id="separator-text">or</span>
            </div>

            <div id="social-signin">
                <ul>
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google"></a></li>
                </ul>
            </div>

            <div id="not-acc">
                <span>Not an account?</span>
                <a href="./register" class="link">Register</a>
            </div>
        </form>
    </main>

</html>