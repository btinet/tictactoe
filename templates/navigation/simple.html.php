<?php

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Service\Host;

?>
<span>Einfache Navigation</span>
<div>
    <a href="<?= Host::route(GameController::class,'index') ?>">Home</a>
    <a href="<?= Host::route(GameController::class,'play') ?>">Game</a>
</div>