<?php

namespace Btinet\Tictactoe\Controller;

use Btinet\Tictactoe\App;

class GameController
{

    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
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

        $this->app->render('game/gameboard.html.php',[
            'title' => 'TicTacTo-Spielbrett'
        ]);
    }

    public function reset()
    {
        // TODO: Spiel zurücksetzen implementieren
    }

}
