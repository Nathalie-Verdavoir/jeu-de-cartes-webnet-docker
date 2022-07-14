<?php

namespace App\Entity;

class ColorName
{
    private const S = 'Piques';
    private const H = 'Coeurs';
    private const C = 'Trèfles';
    private const D = 'Carreaux';

    public static function getName($c):string
    {
        switch ($c) {
            case 'S':
                return self::S;
            case 'H':
                return self::H;
            case 'C':
                return self::C;
            default :
                return self::D;
        }
    }
}