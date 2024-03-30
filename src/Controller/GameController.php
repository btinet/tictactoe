<?php

namespace Btinet\Tictactoe\Controller;

use Btinet\Tictactoe\App;
use Btinet\Tictactoe\Entity\GameField;
use Btinet\Tictactoe\Entity\Player;
use Btinet\Tictactoe\Service\Host;
use Exception;

class GameController
{

    private App $app;
    private array $winSet; // Mögliche Gewinnkombinationen

    /**
     * @throws Exception
     */
    public function __construct(App $app)
    {
        $this->app = $app;

        try {
            if (!isset($_SESSION['current_player'])) {
                $_SESSION['current_player'] = random_int(0, 100) <= 50 ? Player::ONE : Player::TWO;
            }
        } catch (Exception $e) {
            echo 'Fehler beim Initialisieren des Spielers: ' . $e->getMessage();
            // Behandeln Sie die Ausnahme entsprechend, z.B. Standardwert setzen
            $_SESSION['current_player'] = Player::ONE;
        }

        $this->winSet = [
            // Horizontale Dreier
            [new GameField(1, 1, null), new GameField(2, 1, null), new GameField(3, 1, null)],
            [new GameField(1, 2, null), new GameField(2, 2, null), new GameField(3, 2, null)],
            [new GameField(1, 3, null), new GameField(2, 3, null), new GameField(3, 3, null)],

            // Vertikale Dreier
            [new GameField(1, 1, null), new GameField(1, 2, null), new GameField(1, 3, null)],
            [new GameField(2, 1, null), new GameField(2, 2, null), new GameField(2, 3, null)],
            [new GameField(3, 1, null), new GameField(3, 2, null), new GameField(3, 3, null)],

            // Diagonale Dreier
            [new GameField(1, 1, null), new GameField(2, 2, null), new GameField(3, 3, null)],
            [new GameField(1, 3, null), new GameField(2, 2, null), new GameField(3, 1, null)],
        ];

    }

    public function index()
    {
        $winner = null;

        if(isset($_SESSION['winner'])) {
            $winner = $_SESSION['winner'];
        }

        $this->app->render('game/index.html.php',[
            'title' => 'Startseite',
            'winner' => $winner
        ]);
    }

    public function play()
    {
        // Falls es bereits einen Gewinner gibt
        if(isset($_SESSION['winner'])) {
            $target = Host::route(GameController::class,'index');
            Host::redirect($target);
        }

        $x = $_GET['x'] ?? false; // Spalte
        $y = $_GET['y'] ?? false; // Zeile

        // Spielzug durchführen
        $this->makeTurn($x, $y);

        // Template rendern
        $this->app->render('game/play.html.php',[
            'title' => 'TicTacTo-Spielbrett',
            'currentPlayer' => $_SESSION['current_player'],
            'playedFields' => ($_SESSION['played_fields'] ?? null)
        ]);
    }

    public function reset()
    {
        session_destroy();
        $target = Host::route(GameController::class,'play');
        Host::redirect($target);
    }

    private function makeTurn($x, $y)
    {
        if($x and $y) {

            $_SESSION['played_fields'][] = new GameField($x,$y,$_SESSION['current_player']);

            if($_SESSION['current_player'] == Player::ONE) {
                $_SESSION['current_player'] = Player::TWO;
            } else {
                $_SESSION['current_player'] = Player::ONE;
            }
            $this->checkRows();
        }
    }

    private function checkRows()
    {
        // Für jedes Dreier-Set
        foreach ($this->winSet as $fieldSet) {

            // Punktetabelle initialisieren
            $hits = [
                Player::ONE->name => 0,
                Player::TWO->name => 0,
                ];

            // Für jedes bereits gespielte Feld
            foreach ($_SESSION['played_fields'] as $field) {
                /** @var GameField $field */

                // Für jedes Feld aus dem Dreier-Set
                foreach ($fieldSet as $item) {
                    if ($field->equals($item)) {
                        $player = $field->getPlayer();
                        $hits[$player->name]++;

                        if ($hits[Player::ONE->name] == 3) {
                            $this->wins(Player::ONE);
                        }

                        if ($hits[Player::TWO->name] == 3) {
                            $this->wins(Player::TWO);
                        }
                    }
                }

            }

        }

    }

    private function wins(Player $winner)
    {
        $_SESSION['winner'] = $winner;
        $target = Host::route(GameController::class,'index');
        Host::redirect($target);
    }

}
