<?php

namespace Route;

use Controller\CategoryController;
use Controller\TaskController;
use Controller\UserController;
use Helper\Data;
use Helper\Response;

class Routes
{
    private string $request;
    private string $controller;
    private string $method;
    private string $param;
    private array  $allow_proccess = [ 'index' => 'GET', 'find' => 'GET', 'find' => 'GET', 'findall' => 'GET', 'store' => 'POST', 'login'=> 'POST', 'forget_password' => 'POST', 'update_pass' => 'POST', 'update' => 'PUT', 'destroy' => 'DELETE' ];

    public function __construct()
    {
        $this->getPetition();
    }
    /* Get data and proccess petition */
    private function getPetition(): void
    {
        //Get Request
        $this->getRequest();
        $uri =  explode( '/', $_SERVER['REQUEST_URI'] );
        //Get Controller
        $this->getController( $uri[ 2 ] );
        //Get Method
        $this->getMethod( $uri[ 3 ] );
        //Get Params
        $this->getParams( $uri[ 4 ] ?? '' );
        //Process Petition
        $this->validPetition();
        $this->proccessController();
        
    }
    /* Get Request */
    private function getRequest(): void
    {
        $this->request = $_SERVER['REQUEST_METHOD'] ?? '';
    }
    /* Get controller of petiticon */
    public function getController( $controller ): void
    {
        $this->controller = ucfirst( $controller . 'Controller' ) ?? '';
    }
    /* Get Method of petition */
    private function getMethod( $method ): void
    {
        $this->method = $method ?? '';
    }
    /* Get params in case to exist */
    private function getParams( $params ): void
    {
        $this->param = $params ?? '';
    }
    /* Valid a correct controller */
    private function proccessController()
    {
        $instance = null;
        switch ( $this->controller ) {
            case 'UserController':     $instance = new UserController(); break;      
            case 'CategoryController': $instance = new CategoryController(); break;
            case 'TaskController':     $instance = new TaskController(); break;
            default:
            $response = [ 'status' => 400, 'msg' => 'Controller no found' ];
                Response::returnResponse( $response );
            break;
        }
        if( $this->request === 'GET' || $this->request === 'DELETE' ){ $instance->{$this->method}( $this->param ); }
        elseif( $this->request === 'POST' || $this->request === 'PUT' ){
            $data = Data::readData();
            $instance->{$this->method}( $data );
        }
        var_dump( $instance );
        /* $response = $instance::{$this->method()};
        Response::returnResponse( $response ); */
    }

    /* Valid that request and method match */
    private function validPetition(): void
    {
        $isValidProcces = ( array_key_exists( $this->method, $this->allow_proccess ) && $this->allow_proccess[ $this->method ] === $this->request );
        if( !$isValidProcces )
        {
            $response = [
                'status' => 403,
                'msg'    => 'Petition no valid'
            ];
            Response::returnResponse( $response );
        }
    }

}


/* Login */
/* Flight::route( 'POST /login', function() { UserController::login(); } );
Flight::route( 'POST /forget-password', function() { UserController::forget_password(); } );
Flight::route( 'POST /change-password', function() { UserController::update_pass(); } ); */
/* Users Routes */
/* Flight::route( 'GET /users', function() { UserController::index(); } );
Flight::route( 'GET /users/@id', function( $id ) { UserController::find( $id  ); } );
Flight::route( 'POST /users', function() { UserController::store(); } );
Flight::route( 'PUT /users', function() { UserController::update(); } );
Flight::route( 'DELETE /users/@id', function( $id ) { UserController::destroy( $id  ); } ); */
/* Category Routes */
/* Flight::route( 'GET /category', function() { CategoryController::index(); } );
Flight::route( 'GET /category/@id', function( $id ) { CategoryController::find( $id ); } );
Flight::route( 'POST /category', function() { CategoryController::store(); } );
Flight::route( 'PUT /category', function() { CategoryController::update(); } );
Flight::route( 'DELETE /category/@id', function( $id ) { CategoryController::destroy( $id ); } ); */
/* Task Routes */
/* Flight::route( 'GET /task', function() { TaskController::index(); } );
Flight::route( 'GET /task/@id', function( $id ) { TaskController::find( $id ); } );
Flight::route( 'GET /user-task/@id', function( $id ) { TaskController::findAll( $id ); } );
Flight::route( 'POST /task', function() { TaskController::store(); } );
Flight::route( 'PUT /task', function() { TaskController::update(); } );
Flight::route( 'DELETE /task/@id', function( $id ) { TaskController::destroy( $id ); } ); */
