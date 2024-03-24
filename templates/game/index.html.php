<?php

/**
 * @var Player $winner
 */

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Entity\Player;
use Btinet\Tictactoe\Service\Host;

?>
<?php if($winner): ?>
    <h2>Gewinner</h2>
    <i class="bi-<?=$winner->getIcon()?>" style="font-size: 2rem; color:<?=$winner->getColor()?>;"></i>
    <hr>
    <a href="<?=Host::route(GameController::class,'reset')?>">Spiel neustarten</a>
    <?php else: ?>
        <a href="<?=Host::route(GameController::class,'play')?>">Spiel starten</a>
<?php endif; ?>

