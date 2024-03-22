<?php

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Service\ServerService;

?>
<div>
    <a href="<?= ServerService::url(GameController::class,'index') ?>">Home</a>
    <a href="<?= ServerService::url(GameController::class,'play') ?>">Game</a>
</div>