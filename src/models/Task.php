<?php

namespace Model;

use Database\Conection;

class Task
{

    public function __construct()
    {
        
    }

    public function index()
    {
        $sql = ' SELECT t.id AS id, t.name AS name, t.description AS description, u.name AS user, c.name AS category FROM tasks AS t JOIN users AS u ON u.id = t.id_user JOIN categories AS c ON c.id = t.id_category ORDER BY category ';
        $response = Conection::getAll( $sql );
        return $response;
    }

    public function find( $arrData )
    {
        $sql = ' SELECT t.name AS name, t.description AS description, u.name AS user, c.name AS category, c.id AS idCategory FROM tasks AS t JOIN users AS u ON u.id = t.id_user JOIN categories AS c ON c.id = t.id_category WHERE t.id = :id ';
        $response = Conection::find( $sql, $arrData );
        return $response;
    }

    public function findAll( $arrData )
    {
        $sql = ' SELECT t.id AS id, t.name AS name, t.description AS description, u.name AS user, c.name AS category, c.id AS idCategory FROM tasks AS t JOIN users AS u ON u.id = t.id_user JOIN categories AS c ON c.id = t.id_category WHERE u.id = :user ';
        $response = Conection::findAll( $sql, $arrData );
        return $response;
    }

    public function store( $arrData )
    {
        $sql = ' INSERT INTO tasks ( name, description, id_user, id_category ) VALUES ( :name, :description, :user, :category ) ';
        $response = Conection::store( $sql, $arrData );
        return $response;
    }

    public function update( $arrData )
    {
        $sql = ' UPDATE tasks SET name = :name, description = :description, id_user = :user, id_category = :category WHERE id = :id ';
        $response = Conection::update( $sql, $arrData );
        return $response;
    }

    public function destroy( $arrData )
    {
        $sql = ' DELETE FROM tasks WHERE id = :id ';
        $response = Conection::destroy( $sql, $arrData );
        return $response;
    }

}
