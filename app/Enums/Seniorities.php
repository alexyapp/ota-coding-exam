<?php

namespace App\Enums;

enum Seniorities: string
{
    use EnumHelpers;

    case Experienced = 'experienced';
    case Other = 'other';
}