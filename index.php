<?php
// Starting the session
session_start();

require_once "config.php";

// Main Classes
require_once "classes/Messages.php";
require_once "classes/Bootstrap.php";
require_once "classes/Controller.php";
require_once "classes/Model.php";


// Controllers
require_once "controllers/home.php";
require_once "controllers/shares.php";
require_once "controllers/users.php";
require_once "controllers/pesquisar.php";
require_once "controllers/documentos.php";

// Models
require_once "models/home.php";
require_once "models/share.php";
require_once "models/user.php";
require_once "models/pesquisar.php";
require_once "models/documentos.php";

$bt = new Bootstrap($_GET);
$controller = $bt->createController();
if ($controller) {
    $controller->executeAction();
}

