<?php

namespace App\Services\Description;

use App\Contracts\MorphManyDescriptionsInterface;
use App\Models\Description;

interface DescriptionServiceInterface
{
    public function create(MorphManyDescriptionsInterface $model, array $data): Description;
}
