<?php

namespace Btinet\Tictactoe;


use Exception;

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
        $this->routeController();
    }

    private function routeController(): void
    {
        $controllerClass = '';
        try {
            $controllerName = $_GET['controller'] ?? 'game';
            $methodName = $_GET['method'] ?? 'index';

            $controllerClass = __NAMESPACE__ . "\Controller\\" . ucfirst($controllerName) . "Controller";

            if (!class_exists($controllerClass) || !method_exists($controllerClass, $methodName)) {
                throw new Exception("Controller oder Methode nicht gefunden: $controllerClass::$methodName");
            }

            $controller = new $controllerClass($this);
            $controller->$methodName();
        } catch (Exception $e) {
            $this->render('error/404.html.php', [
                'title' => 'Seite nicht gefunden!',
                'class' => $controllerClass,
                'method' => $methodName,
                'error' => $e->getMessage()
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
        $content = $this->loadTemplate($template,$vars);
        $navigation = $this->loadTemplate($this->navigation,$vars);
        $footer = $this->loadTemplate($this->footer,$vars);
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
            extract($vars);
            include $file;
            $content = ob_get_clean();

        } else {
            $content = $template;
        }
        return $content;
    }

}
