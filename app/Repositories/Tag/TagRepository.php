<?php

namespace App\Repositories\Tag;

use App\Contracts\MorphToManyTagsInterface;
use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function firstOrCreate(string $name): Tag
    {
        return Tag::firstOrCreate(compact('name'));
    }

    public function sync(MorphToManyTagsInterface $model, array $tagIds): void
    {
        $model->tags()->sync($tagIds);
    }
}
