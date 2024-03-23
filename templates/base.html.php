<?php

use Btinet\Tictactoe\Service\Host;

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? '' ?></title>
    <!--  Kommentar  -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= Host::link('assets/css/app.css')?>">
</head>
<body>
    <header>
        <nav>
            <?= $navigation ?? '' ?>
        </nav>
    </header>
    <main>
        <?= $content ?? '' ?>
    </main>
    <footer>
        <?= $footer ?? 'AG Informatik' ?>
    </footer>
</body>
</html>
