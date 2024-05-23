<?php

namespace App\Enums;

enum Permissions: string
{
    use EnumHelpers;

    case ModerateJobAds = 'moderate job ads';
    case SeekJobs = 'seek jobs';
}