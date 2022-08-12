<?php

namespace App\Helpers;

class Math 
{
    public static function readable($x)
    {
        $s = ["","K","M","B","T"];
        $len = strlen($x) - 1;
        $c = floor(($len)/3);
        return round($x/pow(1000,$c),1) . $s[$c];
    }
}