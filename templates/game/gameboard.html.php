<?php

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Service\ServerService;

?>
<h1>Spielbrett</h1>
<table>
    <?php for($i = 1; $i <= 3; $i++): ?>
        <tr>
            <?php for($k = 1; $k <= 3; $k++): ?>
                <td>
                    <a href="<?= ServerService::url(GameController::class,'play', ['x' => $k, 'y' => $i] )?>">PLAY</a>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

