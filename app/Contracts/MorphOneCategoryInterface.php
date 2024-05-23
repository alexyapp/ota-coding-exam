<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface MorphOneCategoryInterface
{
    public function category(): MorphOne;
}