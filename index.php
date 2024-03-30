<?php

use Btinet\Tictactoe\App;

const PROJECT_ROOT = __DIR__ . DIRECTORY_SEPARATOR; // Root-Verzeichnis
const TEMPLATES = PROJECT_ROOT . 'templates' . DIRECTORY_SEPARATOR; // Template-Verzeichnis
define('DSN', include_once (PROJECT_ROOT . 'config' . DIRECTORY_SEPARATOR . 'dsn.php')); // DSN Konfiguration

require PROJECT_ROOT . 'vendor/autoload.php';

$app = new App();
