<?php

namespace Helper;

class Data
{

    public static function readData(): object
    {
        $inData = json_decode( file_get_contents( 'php://input' ) ) ?? null;
        return $inData;
    }

    public static function readParams()
    {
        
    }

}
