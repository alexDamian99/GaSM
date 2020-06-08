<?php
$total_pages = ceil($data['pageCount'] / 10);
$page = $data['page'];
$start_page = ($page - 1 <= 0) ? 1 : $page - 1;
$stop_page = ($page + 1 > $total_pages) ? $page : (($page + 2 >= $total_pages) ? $page + 1 : $page + 2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?= getenv('path_to_public') ?>/assets/js/admin_listing.js"></script>
    <script src="<?= getenv('path_to_public') ?>/assets/js/index.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= getenv('path_to_public') ?>/assets/css/template.css">
    <link rel="stylesheet" href="<?= getenv('path_to_public') ?>/assets/css/admin_listing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>GaSM | Admin <?= $data['type'] ?></title>
    <meta name="description" content="Admin <?= $data['type'] ?> listing">
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
            <h2><?= $data['type'] ?> list</h2>
            <div class="wrapper">
                <table>
                    <thead>
                        <?php foreach ($data['headers'] as $head) { ?>
                        <th><?= $head ?></th>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php foreach ($data['elements'] as $element) { ?>
                        <tr>
                            <?php foreach ($element as $key => $value) { ?>
                            <?php if ($key !== 'description') { ?>
                            <td><?= $value ?></td>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($data['type'] === "Campaigns") { ?>
                            <td><a target="_blank"
                                    href="<?= getenv('path_to_public') . '/campaigns/id/' . $element['id'] ?>"><i
                                        class="fa fa-window-restore" aria-hidden="true"></i></a></td>
                            <?php } ?>
                            <td><button onclick="deleteElement('<?= $data['type'] ?>', <?= $element['id'] ?>)"><i
                                        class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <a class="<?php if ($page <= 1) {
                                echo "disabled";
                            } ?>"
                    href="<?= getenv('path_to_public') . "/admin/" . strtolower($data['type']) . "/" . ($page - 1) ?>">
                    << /a> <?php for ($i = $start_page; $i <= $stop_page; $i++) { ?> <a
                            class="<?= ($page == $i) ? "page-active" : '' ?>"
                            href="<?= getenv('path_to_public') . "/admin/" . strtolower($data['type']) . "/" . $i ?>">
                            <?= $i ?>
                        </a>
                        <?php } ?>
                        <a class="<?php if ($page >= $total_pages) {
                            echo "disabled";
                        } ?>"
                            href="<?= getenv('path_to_public') . "/admin/" . strtolower($data['type']) . "/" . ($page + 1) ?>">></a>
            </div>
        </section>
    </main>
</body>

</html>