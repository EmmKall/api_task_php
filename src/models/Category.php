<?php

namespace Model;

use Database\Conection;

class Category
{

    public function __construct()
    {
        
    }

    public function index()
    {
        $sql = ' SELECT id, name FROM categories ORDER BY name ';
        $response = Conection::getAll( $sql );
        return $response;
    }

    public function find( $arrData )
    {
        $sql = ' SELECT id, name FROM categories WHERE id = :id ';
        $response = Conection::find( $sql, $arrData );
        return $response;
    }

    public function store( $arrData )
    {
        $sql = ' INSERT INTO categories ( name ) VALUES ( :name ) ';
        $response = Conection::store( $sql, $arrData );
        return $response;
    }

    public function update( $arrData )
    {
        $sql = ' UPDATE categories SET name = :name WHERE id = :id ';
        $response = Conection::update( $sql, $arrData );
        return $response;
    }

    public function destroy( $arrData )
    {
        $sql = ' DELETE from categories WHERE id = :id ';
        $response = Conection::destroy( $sql, $arrData );
        return $response;
    }

}

