<?php

namespace Btinet\Tictactoe;

class Game
{

    private string $baseTemplate;
    private bool|string $navigation;

    /**
     * @param string $baseTemplate
     */
    public function __construct(string $baseTemplate)
    {
        $this->baseTemplate = $baseTemplate;
        $this->navigation = self::loadTemplate('navigation/default.html.php');

        $method = $_GET['page'] ?? 'index';
        if(method_exists($this,$method))
            $this->$method();
    }


    public function index()
    {
        self::render(false,[
            'title' => 'Startseite'
        ]);
    }

    public function game()
    {
        // TODO: Spiellogik implementieren

        self::render('game/gameboard.html.php',[
            'title' => 'TicTacTo-Spielbrett'
        ]);
    }

    /**
     * @param string|null $template
     * @param array $vars
     * Variablen, die hier lokal erstellt werden, sind auch in den Templates verfügbar.
     */
    private function render(string|null $template, array $vars = [])
    {
        foreach ($vars as $key => $value) {
            ${$key} = $value;
        }
        $navigation = $this->navigation;
        $content = self::loadTemplate($template);

        include TEMPLATES . $this->baseTemplate;
    }

    private function loadTemplate(string $template): bool|string
    {
        $content = false;

        if($template and file_exists($file = TEMPLATES . $template)) {
            ob_start();
            require $file;
            $content = ob_get_clean();
        }
        return $content;
    }

}
