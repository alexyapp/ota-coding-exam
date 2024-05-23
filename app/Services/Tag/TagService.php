<?php

namespace App\Services\Tag;

use App\Contracts\MorphToManyTagsInterface;
use App\Models\Tag;
use App\Repositories\Tag\TagRepositoryInterface;

class TagService implements TagServiceInterface
{
    public function __construct(private TagRepositoryInterface $repository) {}

    public function firstOrCreate(string $name): Tag
    {
        return $this->repository->firstOrCreate($name);
    }

    public function sync(MorphToManyTagsInterface $model, array $tagIds): void
    {
        $this->repository->sync($model, $tagIds);
    }
}