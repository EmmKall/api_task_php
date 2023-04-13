<?php

use Controller\CategoryController;
use Controller\TaskController;
use Controller\UserController;

/* Login */
Flight::route( 'POST /login', function() { UserController::login(); } );
Flight::route( 'POST /forget-password', function() { UserController::forget_password(); } );
Flight::route( 'POST /change-password', function() { UserController::update_pass(); } );
/* Users Routes */
Flight::route( 'GET /users', function() { UserController::index(); } );
Flight::route( 'GET /users/@id', function( $id ) { UserController::find( $id  ); } );
Flight::route( 'POST /users', function() { UserController::store(); } );
Flight::route( 'PUT /users', function() { UserController::update(); } );
Flight::route( 'DELETE /users/@id', function( $id ) { UserController::destroy( $id  ); } );
/* Category Routes */
Flight::route( 'GET /category', function() { CategoryController::index(); } );
Flight::route( 'GET /category/@id', function( $id ) { CategoryController::find( $id ); } );
Flight::route( 'POST /category', function() { CategoryController::store(); } );
Flight::route( 'PUT /category', function() { CategoryController::update(); } );
Flight::route( 'DELETE /category/@id', function( $id ) { CategoryController::destroy( $id ); } );
/* Task Routes */
Flight::route( 'GET /task', function() { TaskController::index(); } );
Flight::route( 'GET /task/@id', function( $id ) { TaskController::find( $id ); } );
Flight::route( 'GET /user-task/@id', function( $id ) { TaskController::findAll( $id ); } );
Flight::route( 'POST /task', function() { TaskController::store(); } );
Flight::route( 'PUT /task', function() { TaskController::update(); } );
Flight::route( 'DELETE /task/@id', function( $id ) { TaskController::destroy( $id ); } );
