<?php

namespace App\Repositories\User;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getByRole(Roles $role): Collection
    {
        return User::query()
            ->whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role->value);
            })
            ->get();
    }
}