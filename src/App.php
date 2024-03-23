<?php

namespace Btinet\Tictactoe;


class App
{

    // Standardwerte setzen
    private string $baseTemplate = 'base.html.php';
    private bool|string $navigation = 'navigation/default.html.php';
    private bool|string $footer = 'AG Informatik';


    public function __construct()
    {
        // Session-Speicher initialisieren
        session_start();

        // Klasse und Methode aus $_GET ziehen
        $controller = $_GET['controller'] ?? 'game';
        $method = $_GET['method'] ?? 'index';

        // Klasse mit Namespace zusammensetzen
        $controller = __NAMESPACE__ . "\Controller\\" . ucfirst($controller) . "Controller";

        // Sollten Klasse und Methode existieren, dann soll ein neues Objekt erzeugt und Methode aufgerufen werden.
        if(class_exists($controller) and method_exists($controller,$method)) {
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
     * @param bool|string $navigation
     */
    public function setNavigation(bool|string $navigation): void
    {
        $this->navigation = $navigation;
    }

    /**
     * @param string $baseTemplate
     */
    public function setBaseTemplate(string $baseTemplate): void
    {
        $this->baseTemplate = $baseTemplate;
    }

    /**
     * @param bool|string $footer
     */
    public function setFooter(bool|string $footer): void
    {
        $this->footer = $footer;
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
        $navigation = self::loadTemplate($this->navigation,$vars);
        $footer = self::loadTemplate($this->footer,$vars);
        include TEMPLATES . $this->baseTemplate;
    }

    /** ob_start() ist der Output Buffer. Die so zu inkludierende Datei wird nicht sofort ausgegeben, sondern
     * erst per "ob_get_clean()" der Variable $content zugewiesen, um an späterer Stelle per echo ausgegeben
     * werden zu können.
     */
    public function loadTemplate(string|false $template, array $vars = []): bool|string
    {
        if($template and file_exists($file = TEMPLATES . $template)) {

            ob_start();

            foreach ($vars as $key => $value) {
                ${$key} = $value;
            }

            include $file;
            $content = ob_get_clean();

        } else {
            $content = $template;
        }
        return $content;
    }

}
