<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo getenv("path_to_public"); ?>/assets/css/forgotPass.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="<?= getenv("path_to_public") ?>/assets/js/register.js"></script>
    <title>GaSM | Recover account</title>
    <meta name="description" content="Recover account">
</head>

<body>
    <main>
        <form action="" method="POST">
            <a class="logo-container" href=<?= getenv("path_to_public") ?>>
                <img id="logo" src="<?php echo getenv("path_to_public"); ?>/assets/images/navbar_logo.png" alt="logo">
            </a>

            <h1>Recover account</h1>

            <p><?php echo $data['text'] ?></p>

            <label>
                <?php
                if ($data['input-type'] == 'email')
                    echo '<input class="input" type="email" name="email" placeholder="Email" required>';
                else if ($data['input-type'] == 'token')
                    echo '<input class="input" type="text" name="token" placeholder="Token" required>';
                else if ($data['input-type'] == 'password')
                    echo '<input class="input" type="password" name="password" placeholder="New Password"
                    onkeyup="checkPassStrength(this.value)" required>'
                ?>
            </label>

            <span id="pass-strength" class="tooltip"></span>

            <span class="display-errors"> <?php if (isset($_SESSION['error'])) {
                                                echo $_SESSION['error'];
                                                unset($_SESSION["error"]);
                                            } ?> </span>


            <button type="submit" name="submit">Submit</button>

        </form>
    </main>

</html>