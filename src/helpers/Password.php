<?php

namespace Helper;
class Password
{

    private const HASH = PASSWORD_DEFAULT;
    private const COST = 14;

    public static function Encryp( $pass ): string
    {
        $pass_hash = password_hash($pass, self::HASH, ['cost' => self::COST]);
        return $pass_hash;
    }

    public static function DesEncryp( $pass, $encryp_pass )
    {
        $isCorrect = password_verify( $pass, $encryp_pass );
        return $isCorrect;

    }

    public static function genereRamdomPassword()
    {
        return uniqid( '', true );
    }    

}