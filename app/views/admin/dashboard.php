<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= getenv('path_to_public') ?>/assets/css/template.css">
    <link rel="stylesheet" href="<?= getenv('path_to_public') ?>/assets/css/dashboard.css">
    <script src="<?= getenv('path_to_public') ?>/assets/js/index.js"></script>
    <script src="<?= getenv('path_to_public') ?>/assets/js/dashboard.js"></script>
    <title>GaSM | Admin Dashboard</title>
    <meta name="description" content="Admin page.">
</head>

<body>
    <header>
        <nav id="navbar">
            <a class="logo-container" href="/">
                <img id="logo" src="<?php echo getenv("path_to_public"); ?>/assets/images/navbar_logo.png" alt="logo">
            </a>
            <ul id="navbar-buttons">
                <li><a href="<?= getenv("path_to_public") ?>/admin">Dashboard</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/campaigns">Campaigns</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/users">Users</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/reports">Reports</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/logout">Logout</a></li>
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
                <li><a href="<?= getenv("path_to_public") ?>/admin">Dashboard</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/campaigns">Campaigns</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/users">Users</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/reports">Reports</a></li>
                <li><a href="<?= getenv("path_to_public") ?>/admin/logout">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="container">
            <h2>Statistics</h2>
            <div class="wrapper">
                <div class="col">
                    <h2>Campaigns</h2>
                    <p>Total number of campaigns: <?= $data['campaignCount'] ?></p>
                </div>
                <div class="col">
                    <h2>Users</h2>
                    <p>Total number of users: <?= $data['userCount'] ?></p>
                </div>
                <div class="col">
                    <h2>Reports</h2>
                    <p>Total number of reports: <?= $data['reportCount'] ?></p>
                </div>
                <div class="col">
                    <h2>Export type </h2>
                    <form method="POST" id="exportType">
                        <label>
                            <input type="checkbox"
                                <?= (isset($data['types']['html']) && $data['types']['html'] == 1) ? "checked" : '' ?>
                                name="exportHTML">
                            HTML
                        </label>
                        <label>
                            <input type="checkbox"
                                <?= (isset($data['types']['pdf']) && $data['types']['pdf'] == 1) ? "checked" : '' ?>
                                name="exportPDF">
                            PDF
                        </label>
                        <label>
                            <input type="checkbox"
                                <?= (isset($data['types']['csv']) && $data['types']['csv'] == 1) ? "checked" : '' ?>
                                name="exportCSV">
                            CSV
                        </label>
                        <input class="btn btn-green" type="submit">
                    </form>
                </div>
            </div>
        </section>
        <section class="container">
            <h2>Companies</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <th>Company id</th>
                        <th>Employee username</th>
                        <th>Verified</th>
                    </thead>
                    <tbody>
                        <?php foreach ($data['companyUsers'] as $companyUser) { ?>
                        <tr>
                            <td><?= $companyUser['id_comp'] ?></td>
                            <td><?= $companyUser['username'] ?></td>
                            <td><input <?= ($companyUser['verified'] == 1 ? "checked" : "") ?>
                                    onclick="verifyUser('<?= $companyUser['username'] ?>')" type="checkbox" /></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>

</html>