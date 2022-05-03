<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    private Role $adminRole;

    public function __construct(
        Role $adminRole,
    )
    {
        $this->adminRole = $adminRole;
    }

    public function update(?User $user): bool
    {
        return null !== $user && $user->hasRole($this->getAdminRole());
    }

    protected function getAdminRole(): Role
    {
        return $this->adminRole;
    }
}
