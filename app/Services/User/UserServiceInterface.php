<?php

namespace App\Services\User;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getByRole(Roles $role): Collection;
}
