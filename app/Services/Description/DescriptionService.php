<?php

namespace App\Services\Description;

use App\Contracts\MorphManyDescriptionsInterface;
use App\Models\Description;
use App\Repositories\Description\DescriptionRepositoryInterface;

class DescriptionService implements DescriptionServiceInterface
{
    public function __construct(private DescriptionRepositoryInterface $repository) {}

    public function create(MorphManyDescriptionsInterface $model, array $data): Description
    {
        return $this->repository->create($model, $data);
    }
}