<?php

namespace App\Repositories\Tag;

use App\Contracts\MorphToManyTagsInterface;
use App\Models\Tag;

interface TagRepositoryInterface
{
    public function firstOrCreate(string $name): Tag;

    public function sync(MorphToManyTagsInterface $model, array $tagIds): void;
}