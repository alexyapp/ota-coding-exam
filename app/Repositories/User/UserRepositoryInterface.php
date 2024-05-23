<?php

namespace App\Repositories\User;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getByRole(Roles $role): Collection;
}