<?php

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Service\Host;

?>
<div>
    <a href="<?= Host::route(GameController::class,'index') ?>">Home</a>
    <a href="<?= Host::route(GameController::class,'play') ?>">Game</a>
</div>