<?php

namespace App\Services\Tag;

use App\Contracts\MorphToManyTagsInterface;
use App\Models\Tag;

interface TagServiceInterface
{
    public function firstOrCreate(string $name): Tag;

    public function sync(MorphToManyTagsInterface $model, array $tagIds): void;
}