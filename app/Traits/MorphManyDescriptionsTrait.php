<?php

namespace App\Traits;

use App\Models\Description;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphManyDescriptionsTrait
{
    public function descriptions(): MorphMany
    {
        return $this->morphMany(Description::class, 'describable');
    }
}