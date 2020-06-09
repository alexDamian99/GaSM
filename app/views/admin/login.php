<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= getenv("path_to_public") ?>/assets/css/signin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GaSM | Admin Login</title>
</head>

<body>
    <main>
        <form action="<?= getenv("path_to_public") ?>/admin/login" method="POST" id="credentials">
            <a class="logo-container" href="<?= getenv("path_to_public") ?>">
                <img id=" logo" src="<?= getenv("path_to_public") ?>/assets/images/navbar_logo.png" alt="logo">
            </a>
            <h1>Admin sign in</h1>
            <label class="input-credentials">
                <span>Username</span> <br>
                <input class="input" type="text" name="username" placeholder="&#xF007; Type your username" required>
            </label>
            <label class="input-credentials">
                <span>Password</span> <br>
                <input class="input" type="password" name="password" placeholder="&#xF023; Type your password" required>
            </label>
            <button type="submit" name="submit">Sign in</button>
            <span class="display-errors" id="errors"><?php if (isset($data['failed']) && $data['failed']) {
                                                            echo "Failed login. Please try again, with an admin account.";
                                                        } ?></span>
        </form>
    </main>
</body>

</html>