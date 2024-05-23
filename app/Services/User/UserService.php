<?php

namespace App\Services\User;

use App\Enums\Roles;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function getByRole(Roles $role): Collection
    {
        return $this->repository->getByRole($role);
    }
}
