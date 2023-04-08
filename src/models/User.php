<?php

namespace Model;

use Database\Conection;
use Helper\Response;

class User
{

    public function __construct()
    {
        
    }

    public function index(): array
    {
        $sql = ' SELECT name, email, phone FROM users ';
        $response = Conection::getAll( $sql );
        return $response;
    }

    public function find( $arrData ): array
    {
        $sql = " SELECT id, name, email, phone FROM users WHERE id = :id ";
        $response = Conection::find( $sql, $arrData );
        return $response;
    }

    public function store( $data ): array
    {
        $sql = ' INSERT INTO users ( name, email, phone, password ) VALUES ( :name, :email, :phone, :password ) ';
        $response = Conection::store( $sql, $data );
        return $response;
    }

    public function update( $arrData ): array
    {
        if( $arrData[':password'] !== ''  )
        {
            $sql = ' UPDATE users SET name = :name, email = :email, phone = :phone, password = :password WHERE id = :id ';
        } else 
        {
            $sql = ' UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id ';
        }
        $response = Conection::update( $sql, $arrData );
        return $response;
    }

    public function destroy( $arrData ): array
    {
        $sql = " DELETE FROM users WHERE id = :id ";
        $response = Conection::find( $sql, $arrData );
        return $response;
    }

    public function login( $arrData ): array
    {
        $sql = ' SELECT id, name, email, password FROM users WHERE email = :email ';
        $response = Conection::find( $sql, $arrData );
        return $response;
    }

    public static function setToken( $arrData ): array
    {
        $sql = ' UPDATE users SET token = :token WHERE id = :id';
        $response = Conection::update( $sql, $arrData );
        return $response;

    }

}
