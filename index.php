<?php

/* Headers */
header("Access-Control-Allow-Origin: http://localhost:4200 ");
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


require 'vendor/autoload.php';
/* Dotenv */
$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->load();

/* Incluir rutas */
//Request: GET; POST, PUT, DELETE
//Methos: getall, find, findall, store, destroy
use Route\Routes;
$rutes = new Routes();


