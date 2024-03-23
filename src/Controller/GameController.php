<?php

namespace Btinet\Tictactoe\Controller;

use Btinet\Tictactoe\App;
use Btinet\Tictactoe\Entity\GameField;
use Btinet\Tictactoe\Entity\Player;

class GameController
{

    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;

        if(!isset($_SESSION['current_player'])) {
            $_SESSION['current_player'] = Player::ONE;
        }

    }

    public function index()
    {
        // TODO: Landing-Page implementieren (bevor das Spiel startet)

        $this->app->setNavigation('navigation/simple.html.php');
        $this->app->render(false,[
            'title' => 'Startseite'
        ]);
    }

    public function play()
    {
        // TODO: Spiellogik implementieren
        $x = $_GET['x'] ?? false; // Spalte
        $y = $_GET['y'] ?? false; // Zeile

        // Spieler wechseln
        self::makeTurn($x, $y);

        $this->app->render('game/play.html.php',[
            'title' => 'TicTacTo-Spielbrett',
            'currentPlayer' => $_SESSION['current_player'],
            'playedFields' => $_SESSION['played_fields']
        ]);
    }

    public function reset()
    {
        session_destroy();
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
        }
    }

}
