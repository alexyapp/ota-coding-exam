<?php

namespace App\Enums;

enum EmploymentTypes: string
{
    use EnumHelpers;

    case Permanent = 'permanent';
    case Other = 'other';
}