<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface MorphManyDescriptionsInterface
{
    public function descriptions(): MorphMany;
}