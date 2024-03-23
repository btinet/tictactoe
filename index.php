<?php

use Btinet\Tictactoe\App;

session_start();

const PROJECT_ROOT = __DIR__ . DIRECTORY_SEPARATOR; // Root-Verzeichnis
const TEMPLATES = PROJECT_ROOT . 'templates' . DIRECTORY_SEPARATOR; // Template-Verzeichnis

require PROJECT_ROOT . 'vendor/autoload.php';

$game = new App();
