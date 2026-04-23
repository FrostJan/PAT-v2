<?php

namespace App\Support;

class DepartmentColor
{
    public static function for(string $department): string
    {
        $hash = substr(md5($department), 0, 6);

        return '#'.$hash;
    }
}
