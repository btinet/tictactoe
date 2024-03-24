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

        if(!isset($_SESSION['current_player'])) {
            if(random_int(0,100)<=50) {
                $_SESSION['current_player'] = Player::ONE;
            } else {
                $_SESSION['current_player'] = Player::TWO;
            }

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

        $this->app->setNavigation('navigation/simple.html.php');
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

            $hits1 = 0;
            $hits2 = 0;
            foreach ($_SESSION['played_fields'] as $field) {
                /** @var GameField $field */

                if ($field->getPlayer() == Player::ONE) {

                    foreach ($fieldSet as $item) {
                        if($field->equals($item)){
                            $hits1++;
                            if($hits1 == 3) {
                                $this->wins(Player::ONE);
                            }
                        }
                    }

                } elseif($field->getPlayer() == Player::TWO) {

                    foreach ($fieldSet as $item) {
                        if($field->equals($item)){
                            $hits2++;
                            if($hits2 == 3) {
                                $this->wins(Player::TWO);
                            }
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
