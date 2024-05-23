<?php

namespace App\Enums;

enum Roles: string
{
    use EnumHelpers;

    case Moderator = 'moderator';
    case JobSeeker = 'job seeker';
}