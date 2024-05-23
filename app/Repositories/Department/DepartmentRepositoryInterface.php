<?php

namespace App\Repositories\Department;

use App\Models\Department;

interface DepartmentRepositoryInterface
{
    public function firstOrCreate(string $name): Department;
}