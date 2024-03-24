<?php

use Btinet\Tictactoe\Service\Host;

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="TicTacToe PHP-Spiel">

    <title><?= $title ?? '' ?></title>
    <!--  Kommentar  -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= Host::link('assets/css/app.css')?>">

    <link rel="icon" type="image/x-icon" href="<?= Host::link('assets/img/favicon.ico') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Host::link('assets/img/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Host::link('assets/img/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Host::link('assets/img/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= Host::link('site.webmanifest') ?>">
    <link rel="mask-icon" href="<?= Host::link('assets/img/safari-pinned-tab.svg') ?>" color="#5bbad5">
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
