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
require_once "controllers/inicio.php";
require_once "controllers/shares.php";
require_once "controllers/users.php";
require_once "controllers/pesquisar.php";
require_once "controllers/documentos.php";
require_once "controllers/comandosMunicipais.php";
require_once "controllers/comandosProvinciais.php";
require_once "controllers/ComandoNacional.php";
require_once "controllers/agentes.php";
require_once "controllers/palavrapasse.php";
require_once "controllers/postos.php";
require_once "controllers/mais.php";
require_once "controllers/bairros.php";
require_once "controllers/categorias.php";
require_once "controllers/distritos.php";
require_once "controllers/municipios.php";
require_once "controllers/provincias.php";
require_once "controllers/cidadaos.php";
// Models
require_once "models/inicio.php";
require_once "models/share.php";
require_once "models/user.php";
require_once "models/pesquisar.php";
require_once "models/documento.php";
require_once "models/comandoMunicipal.php";
require_once "models/comandoProvincial.php";
require_once "models/ComandoNacional.php";
require_once "models/agente.php";
require_once "models/palavrapasse.php";
require_once "models/posto.php";
require_once "models/mais.php";
require_once "models/bairro.php";
require_once "models/categoria.php";
require_once "models/distrito.php";
require_once "models/municipio.php";
require_once "models/provincia.php";
$bt = new Bootstrap($_GET);
$controller = $bt->createController();
if ($controller) {
    $controller->executeAction();
}

// TODO fazer uma função que verifica se existe um parametro ou não e retorna erro

