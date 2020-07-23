<?php

use Slim\Http\Request;
use Slim\Http\Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;

// Configuración de cabeceras
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

// GET Pagina principal
$app->get('/', function(Request $request, Response $response){
    echo 'Bienvenido: Products v1.0';
});

// Rutas
require '../src/routes/products.php';

$app->run();