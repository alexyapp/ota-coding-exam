<?php

namespace App\Enums;

enum Schedules: string
{
    use EnumHelpers;

    case FullTime = 'full-time';
    case Other = 'other';
}