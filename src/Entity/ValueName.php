<?php

namespace App\Entity;

class ValueName
{
    private const T = '10';
    private const J = 'Valet';
    private const Q = 'Dame';
    private const K = 'Roi';
    private const A = 'As';

    public static function getName($c):string
    {
        switch ($c) {
            case 'T':
                return self::T;
            case 'J':
                return self::J;
            case 'Q':
                return self::Q;
            case 'K':
                return self::K;
            case 'A':
                return self::A;
            default :
                return $c;
        }
    }
}
