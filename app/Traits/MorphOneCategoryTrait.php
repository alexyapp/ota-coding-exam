<?php

namespace App\Traits;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait MorphOneCategoryTrait
{
    public function category(): MorphOne
    {
        return $this->morphOne(Category::class, 'categorizable');
    }
}