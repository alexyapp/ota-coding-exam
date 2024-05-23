<?php

namespace App\Services\Department;

use App\Models\Department;

interface DepartmentServiceInterface
{
    public function firstOrCreate(string $name): Department;
}