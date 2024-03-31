<?php

/**
 * @var Player $winner
 */

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Entity\Player;
use Btinet\Tictactoe\Service\Host;

?>
<h1>Lobby</h1>

<?php if($winner): ?>
    <?php if($winner != 'draw'): ?>
    <section>
        <p>Gewinner: <i class="bi-<?=$winner->getIcon()?>" style="font-size: 2rem; color:<?=$winner->getColor()?>;"></i></p>
    </section>
    <section>
        <a href="<?=Host::route(GameController::class,'reset')?>">Spiel neustarten</a>
    </section>
    <?php else: ?>
<section>
        <p>Unentschieden</p>
    </section>
        <section>
            <a href="<?=Host::route(GameController::class,'reset')?>">Spiel neustarten</a>
        </section>
    <?php endif; ?>
<?php else: ?>
    <section>
        <a href="<?=Host::route(GameController::class,'play')?>">Spiel starten</a>
    </section>
<?php endif; ?>



