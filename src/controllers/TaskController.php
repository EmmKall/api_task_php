<?php

namespace Controller;

use Flight;
use Model\Task;
use Helper\Response;
use Helper\ValidData;
use Helper\Validjwt;

class TaskController
{
    public static function index()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $task = new Task();
        $response = $task->index();
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
        $task = new Task();
        $response = $task->find( $arrData );
        Response::returnResponse( $response );
    }

    public static function findAll( $user )
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $isNumeric = ValidData::isNumeric( $user );
        if( sizeof( $isNumeric ) > 0 ) { Response::returnResponse( $isNumeric ); }
        /* Create data */
        $arrData = [':user' => $user ];
        $task = new Task();
        $response = $task->findAll( $arrData );
        Response::returnResponse( $response );
    }

    public static function store()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $data = Flight::request()->data;
        $labelsIn = [ 'name', 'description', 'user', 'category' ];
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        /* Create data */
        $arrData = [
            ':name'        => $data->name,
            ':description' => $data->description,
            ':user'        => $data->user,
            ':category'    => $data->category
        ];
        $task = new Task();
        $response = $task->store( $arrData );
        Response::returnResponse( $response );
    }

    public static function update()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $data = Flight::request()->data;
        $labelsIn = [ 'id', 'name', 'description', 'user', 'category' ];
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        /* Create data */
        $arrData = [
            ':id'          => $data->id,
            ':name'        => $data->name,
            ':description' => $data->description,
            ':user'        => $data->user,
            ':category'    => $data->category
        ];
        $task = new Task();
        $response = $task->update( $arrData );
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
        $task = new Task();
        $response = $task->destroy( $arrData );
        Response::returnResponse( $response );
    }

}
