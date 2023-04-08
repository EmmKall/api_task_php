<?php
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

require 'vendor/autoload.php';
/* Dotenv */
$dotenv = Dotenv\Dotenv::createImmutable( __DIR__ );
$dotenv->load();

use Controller\UserController;

/* Login */
Flight::route('POST /login', function() { UserController::login(); } );
Flight::route('POST /forget-password', function() { UserController::forget_password(); } );
/* Users Routes */
Flight::route('GET /users', function() { UserController::index(); } );
Flight::route('GET /users/@id', function( $id ) { UserController::find( $id  ); } );
Flight::route('POST /users', function() { UserController::store(); } );
Flight::route('PUT /users', function() { UserController::update(); } );
Flight::route('DELETE /users/@id', function( $id ) { UserController::destroy( $id  ); } );
/* Category Routes */

/* Task Routes */


/* Flight::route('GET /', function(){ echo 'GET Method'; });
Flight::route('GET /@id', function( $id ){ echo $id; });
Flight::route('POST /', function(){ echo json_encode(Flight::request()->data); }); //Flight::request()->files
Flight::route('PUT /', function(){ echo 'Put method!'; });
Flight::route('DELETE /', function(){ echo 'Delete method!'; }); */

Flight::start();


