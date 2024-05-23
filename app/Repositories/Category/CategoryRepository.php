<?php

namespace App\Repositories\Category;

use App\Contracts\MorphOneCategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function associate(MorphOneCategoryInterface $model, string $name): Category
    {
        return Category::firstOrCreate(
            ['name' => $name],
            [
                'categorizable_id' => $model->getKey(),
                'categorizable_type' => $model::class,
            ]
        );
    }
}