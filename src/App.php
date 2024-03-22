<?php

namespace Btinet\Tictactoe;


class App
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

        // Klasse und Methode aus $_GET ziehen
        $controller = $_GET['controller'] ?? 'game';
        $method = $_GET['method'] ?? 'index';

        // Klasse mit Namespace zusammensetzen
        $controller = __NAMESPACE__ . "\Controller\\" . ucfirst($controller) . "Controller";

        // Sollten Klasse und Methode existieren, dann soll ein neues Objekt erzeugt und Methode aufgerufen werden.
        if(method_exists($controller,$method)) {
            $controller = new $controller($this);
            $controller->$method();
        } else {
            self::render('error/404.html.php',[
                'title' => 'Seite nicht gefunden!',
                'class' => $controller,
                'method' => $method
            ]);
        }
    }

    /**
     * @param string|null $template
     * @param array $vars
     * Variablen, die hier lokal erstellt werden, sind auch in den Templates verfügbar.
     */
    public function render(string|null $template, array $vars = [])
    {
        foreach ($vars as $key => $value) {
            ${$key} = $value;
        }
        $app = $this;
        $content = self::loadTemplate($template,$vars);
        $navigation = $this->navigation;
        include TEMPLATES . $this->baseTemplate;
    }

    public function loadTemplate(string $template, array $vars = []): bool|string
    {
        $content = false;

        if($template and file_exists($file = TEMPLATES . $template)) {
            ob_start();
            foreach ($vars as $key => $value) {
                ${$key} = $value;
            }
            include $file;
            $content = ob_get_clean();
        }
        return $content;
    }

}
