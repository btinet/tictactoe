<?php

use Btinet\Tictactoe\Service\Host;

?>
<h1><?= $title ?? 'Seite nicht gefunden!'?></h1>
<p>
    Der angegebene Controller <code><?= $class ?? '' ?></code>
    und/oder die Methode <code><?= $method ?? '' ?></code> konnte nicht gefunden werden!
</p>
<img src="<?= Host::link('assets/img/error-page.webp')?>" alt="404 Logo">
