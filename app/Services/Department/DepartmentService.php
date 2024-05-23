<?php

namespace App\Services\Department;

use App\Models\Department;
use App\Repositories\Department\DepartmentRepositoryInterface;

class DepartmentService implements DepartmentServiceInterface
{
    public function __construct(private DepartmentRepositoryInterface $repository) {}

    public function firstOrCreate(string $name): Department
    {
        return $this->repository->firstOrCreate($name);
    }
}