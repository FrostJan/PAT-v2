<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case DepartmentOffice = 'department_office';
    case Student = 'student';

    public static function values(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }
}
