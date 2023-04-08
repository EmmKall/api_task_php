<?php

namespace Helper;

class Response
{

    public static function returnResponse( $data )
    {
        die( json_encode( $data ) );
    }

}
