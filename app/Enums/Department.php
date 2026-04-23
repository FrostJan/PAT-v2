<?php

namespace App\Enums;

enum Department: string
{
    case ArtsAndSciences = 'College of Arts and Sciences';
    case BusinessAndAccountancy = 'College of Business and Accountancy';
    case ComputerStudies = 'College of Computer Studies';
    case Criminology = 'College of Criminology';
    case Education = 'College of Education';
    case EngineeringAndAviation = 'College of Engineering and Aviation';
    case InternationalHospitalityManagement = 'College of International Hospitality Management';
    case Maritime = 'College of Maritime';
    case SeniorHighSchool = 'Senior High School';
    case BasicEducation = 'Basic Education';

    public static function values(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }
}
