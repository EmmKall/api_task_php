<?php

namespace Controller;

use Flight;
use Model\Category;
use Helper\Response;
use Helper\ValidData;
use Helper\Validjwt;

class CategoryController
{

    public static function index()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $category = new Category();
        $response = $category->index();
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
        $category = new Category();
        $response = $category->find( $arrData );
        Response::returnResponse( $response );
    }

    public static function store()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $data = Flight::request()->data;
        $labelsIn = [ 'name' ];
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        /* Create data */
        $arrData =[
            ':name' => $data->name
        ];
        $category = new Category();
        $response = $category->store( $arrData );
        Response::returnResponse( $response );
    }

    public static function update()
    {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $data = Flight::request()->data;
        $labelsIn = [ 'id', 'name' ];
        $validIn = ValidData::validIN( $data, $labelsIn );
        if( sizeof( $validIn) > 0 ) { Response::returnResponse( $validIn ); }
        /* Create data */
        $arrData =[
            ':id'   => $data->id,
            ':name' => $data->name
        ];
        $category = new Category();
        $response = $category->update( $arrData );
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
        $category = new Category();
        $response = $category->destroy( $arrData );
        Response::returnResponse( $response );
    }

}

