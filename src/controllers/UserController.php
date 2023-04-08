<?php

namespace Controller;

use Flight;
use Model\User;
use Helper\ValidData;
use Helper\Password;
use Helper\Response;
use Helper\Validjwt;

class UserController
{
    public static function index()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        //$validUser = Validjwt::validJWT( $jtk );
        $user = new User();
        $response = $user->index();
        Response::returnResponse( $response );
    }

    public static function find( $id )
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $isNumeric = ValidData::isNumeric( $id );
        if( sizeof( $isNumeric ) > 0 ) { Response::returnResponse( $isNumeric ); }
        /* Create data */
        $arrData = [':id' => $id ];
        $user = new User();
        $response = $user->find( $arrData );
        Response::returnResponse(( $response ) );
    }
    
    public static function store()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $data = Flight::request()->data;
        $labelsIn = [ 'name', 'email', 'phone', 'password' ];
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        /* Create data */
        $arrData = [
            ':name'     => $data->name,
            ':email'    => $data->email,
            ':phone'    => $data->phone,
            ':password' => Password::Encryp( $data->password ),
        ];
        $user = new User();
        $user = $user->store( $arrData );
        
        Response::returnResponse( $user );
    }

    public static function update()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $data = Flight::request()->data;
        $labelsIn = [  'id', 'name', 'email', 'phone' ];
        /* Valid data */
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        /* Valid id */
        $isNumeric = ValidData::isNumeric( $data->id );
        if( sizeof( $isNumeric ) > 0 ) { Response::returnResponse( $isNumeric ); }
        $user = new User();
        /* Create Data */
        $arrData = [
            ':id'       => $data->id,
            ':name'     => $data->name,
            ':email'    => $data->email,
            ':phone'    => $data->phone,
        ];
        $arrData[':password'] = ( $data->password !== null && trim( $data->password ) !== '' ) ? Password::Encryp( $data->password ) : '';
        $response = $user->update( $arrData );
        Response::returnResponse( $response );
    }

    public static function destroy( $id )
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $isNumeric = ValidData::isNumeric( $id );
        if( sizeof( $isNumeric ) > 0 ) { Response::returnResponse( $isNumeric ); }
        /* Create data */
        $arrData = [':id' => $id ];
        $user = new User();
        $response = $user->destroy( $arrData );
        Response::returnResponse( $response );
    }

    public static function login()
    {
        $data = Flight::request()->data;
        $labelsIn = [ 'email', 'password' ];
        /* Valid data */
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        /* Create data */
        $arrData = [ ':email' => $data->email ];
        $user = new User();
        $findUser = $user->login( $arrData );
        if( !$findUser[ 'data' ] ){ Response::returnResponse([
            'status' => 403,
            'msg'    => 'Email y/o password not valid'
        ]); }
        /* Update Token */
        $id    = $findUser[ 'data' ][ 'id' ];
        $email = $findUser[ 'data' ][ 'email' ];
        $token = Validjwt::setToken( $id, $email );
        /* Actualizar Token */
        $arrData = [
            ':token' => $token,
            ':id'    =>$id
        ];
        $updateToken = $user->setToken( $arrData );
        if( $updateToken[ 'status' ] === 200 )
        {
            Response::returnResponse([
                'status' => 200,
                'data'   => [
                    'user'   => $findUser[ 'data' ][ 'name' ],
                    'token'  => $token
                ]
            ]);
        } else
        {
            Response::returnResponse([
                'status' => 500,
                'msg'   => 'internal error'
            ]);
        }
    }

    public static function forget_password()
    {
        $data = Flight::request()->data;
        $labelsIn = [ 'email' ];
        /* Valid data */
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        $arrData = [ ':email' => $data->email ];
        $user = new User();
        $findUser = $user->login( $arrData );
        if( !$findUser[ 'data' ] ){ Response::returnResponse([
            'status' => 403,
            'msg'    => 'Internal error'
        ]); }
        /* Generar ramdom password */
        $new_pass = Password::genereRamdomPassword();
        /* Send by email */
        Response::returnResponse([
            'status'   => 200,
            'email'    => $data->email,
            'new_pass' => $new_pass
        ]);
    }

    public static function update_pass()
    {
        $data = Flight::request()->data;
        $labelsIn = [ 'email', 'password' ];
    }

}
