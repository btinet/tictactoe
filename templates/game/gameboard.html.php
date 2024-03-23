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
                    <a href="<?= ServerService::url(GameController::class,'play', ['x' => $k, 'y' => $i] )?>">
                        <i class="bi-grid-3x3-gap-fill" style="font-size: 2rem; color: lightgray;"></i>
                    </a>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>
<h2>Verfügbare Spieler</h2>
<i class="bi-circle" style="font-size: 2rem; color: black;"></i>
<i class="bi-x-lg" style="font-size: 2rem; color: darkred;"></i>

