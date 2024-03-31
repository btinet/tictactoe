<?php

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Service\Host;

?>
<div>
    <a href="<?= Host::route(GameController::class,'index') ?>">Lobby</a>
    <a href="<?= Host::route(GameController::class,'play') ?>">Spielbrett</a>
</div>