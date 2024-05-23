<?php

namespace App\Enums;

enum YearsOfExperience: string
{
    use EnumHelpers;

    case OneToTwo = '1-2';
    case FiveToSeven = '5-7';
    case Other = 'other';
}