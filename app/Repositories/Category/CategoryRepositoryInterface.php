<?php

namespace App\Repositories\Category;

use App\Contracts\MorphOneCategoryInterface;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function associate(MorphOneCategoryInterface $model, string $name): Category;
}