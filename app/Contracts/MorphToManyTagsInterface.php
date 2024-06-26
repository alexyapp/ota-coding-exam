<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface MorphToManyTagsInterface
{
    public function tags(): MorphToMany;
}