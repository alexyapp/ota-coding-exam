<?php

namespace App\Services\Category;

use App\Contracts\MorphOneCategoryInterface;
use App\Models\Category;

interface CategoryServiceInterface
{
    public function associate(MorphOneCategoryInterface $model, string $name): Category;
}