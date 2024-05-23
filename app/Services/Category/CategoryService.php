<?php

namespace App\Services\Category;

use App\Contracts\MorphOneCategoryInterface;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(private CategoryRepositoryInterface $repository) {}

    public function associate(MorphOneCategoryInterface $model, string $name): Category
    {
        return $this->repository->associate($model, $name);
    }
}