<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/forgotPass.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GaSM | Recover account</title>
</head>

<body>
    <main>
        <form action="" method="POST">
            <a class="logo-container" href="./index">
                <img id="logo" src="../public/assets/images/navbar_logo.png" alt="logo">
            </a>

            <h1>Recover account</h1>

            <p>Enter your email adress and follow the steps to recover your account.</p>

            <label>
                <input class="input" type="email" name="email" placeholder="Email" required value="<?php if (isset($_COOKIE["temp_email"])) {
                                                                                                        echo $_COOKIE["temp_email"];
                                                                                                    } ?>">
            </label>


            <button type="submit" name="submit">Submit</button>

        </form>
    </main>

</html>