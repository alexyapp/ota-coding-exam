<?php

namespace App\Repositories\Description;

use App\Contracts\MorphManyDescriptionsInterface;
use App\Models\Description;

class DescriptionRepository implements DescriptionRepositoryInterface
{
    public function create(MorphManyDescriptionsInterface $model, array $data): Description
    {
        $description = new Description;
        $description->title = $data['title'] ?? null;
        $description->body = $data['body'];
        $description->describable_type = $model::class;
        $description->describable_id = $model->getKey();
        $description->save();

        return $description;
    }
}