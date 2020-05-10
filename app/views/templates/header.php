<header>
    <nav id="navbar">
        <a class="logo-container" href="../public">
            <img id="logo" src="<?php echo getenv("path_to_public"); ?>/assets/images/navbar_logo.png" alt="logo">
        </a>
        <ul id="navbar-buttons">
            <li><a href="<?= getenv("path_to_public") ?>/report">Report event</a></li>
            <li><a href="<?= getenv("path_to_public") ?>/statistics">Statistics</a></li>
            <li><a href="<?= getenv("path_to_public") ?>/campaigns">Campaigns</a></li>
            <?php if(isset($_SESSION['username']) || isset($_SESSION['id'])) { ?>
                <li><a href="<?= getenv("path_to_public") ?>/campaigns/add">Create a campaign</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/profile">Profile</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/">Log out</a></li>
            <?php } else { ?>
                <li><a href="<?= getenv("path_to_public") ?>/register">Register</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/signin">Sign In</a></li>
            <?php } ?>
        </ul>
        <a href="javascript:void(0);" id="cheese-burger" onclick="myFunction()">
            <span>
                <div></div>
                <div></div>
                <div></div>
            </span>
        </a>
    </nav>
    <nav id="mobile-navbar">
        <ul id="mobile-navbar-buttons">
            <li><a href="<?= getenv("path_to_public") ?>/report">Report event</a></li>
            <li><a href="<?= getenv("path_to_public") ?>/statistics">Statistics</a></li>
            <li><a href="<?= getenv("path_to_public") ?>/campaigns">Campaigns</a></li>
            <?php if(isset($_SESSION['username']) || isset($_SESSION['id'])) { ?>
                <li><a href="<?= getenv("path_to_public") ?>/campaigns/add">Create a campaign</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/profile">Profile</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/">Log out</a></li>
            <?php } else { ?>
                <li><a href="<?= getenv("path_to_public") ?>/register">Register</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/signin">Sign In</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>