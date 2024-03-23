<?php

use Btinet\Tictactoe\Controller\GameController;
use Btinet\Tictactoe\Entity\GameField;
use Btinet\Tictactoe\Service\Host;

/**
 * @var array $playedFields
 * @var GameField $field
 */

?>
<h1>Spielbrett</h1>
<table>
    <?php for($i = 1; $i <= 3; $i++): ?>
        <tr>
            <?php for($k = 1; $k <= 3; $k++): ?>
                <td>

                    <?php
                    $found = false;
                    foreach($playedFields as $field) {
                        if($i == $field->getY() and $k == $field->getX()) {
                            echo '<i class="bi-'.$field->getPlayer()->getIcon().'" style="font-size: 2rem; color: '.$field->getPlayer()->getColor().';"></i>';
                            $found = true;
                            break;
                        }
                    }
                    ?>

                    <?php if(!$found): ?>
                        <a href="<?= Host::route(GameController::class,'play', ['x' => $k, 'y' => $i] )?>">
                            <i class="bi-grid-3x3-gap-fill" style="font-size: 2rem; color: lightgray;"></i>
                        </a>
                    <?php endif; ?>

                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>
<h2>Verfügbare Spieler</h2>
<i class="bi-circle" style="font-size: 2rem; color: black;"></i>
<i class="bi-x-lg" style="font-size: 2rem; color: darkred;"></i>


