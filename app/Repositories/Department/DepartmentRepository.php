<?php

namespace App\Repositories\Department;

use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function firstOrCreate(string $name): Department
    {
        return Department::firstOrCreate(compact('name'));
    }
}
