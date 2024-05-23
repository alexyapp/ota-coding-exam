<?php

namespace App\Repositories\Description;

use App\Contracts\MorphManyDescriptionsInterface;
use App\Models\Description;

interface DescriptionRepositoryInterface
{
    public function create(MorphManyDescriptionsInterface $model, array $data): Description;
}