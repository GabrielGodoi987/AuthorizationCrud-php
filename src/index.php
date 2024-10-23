<?php
namespace Token\App;

use Token\App\Routes\Rotas;
use Token\App\Routes\Router;
require "../vendor/autoload.php";


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}


$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if(!$method == "POST" && ($uri == '/login' || $uri == '/users')) {
    // validar o token com a classe TokenManager
}

$arraysRotas = Rotas::fastRotas();

Router::resolve($arraysRotas, $method, $uri);