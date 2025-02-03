<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Filters\UserFilter;
use App\Models\Filters\ActiveFilter;
use App\Models\Filters\User\RoleFilter;
use App\Models\Filters\CreatedAtDateRangeFilter;

class UserBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new UserFilter(fn($users) => $this->hasUser($users)),
            new RoleFilter(fn($role) => $this->hasRole($role)),
            new ActiveFilter(fn($active) => $this->isActive($active)),
            new CreatedAtDateRangeFilter(fn($date) => $this->isCreatedAtRange($date)),
        ];
    }

    /**
     * @param array|null $users
     * @return $this
     */
    final public function hasUser(?array $users): static
    {
        return $this->when(count($users), fn($q) => $q->whereIn('id', $users));
    }

    /**
     * @param array|null $role
     * @return $this
     */
    final public function hasRole(?array $role): static
    {
        return $this->when(count($role), function($q) use ($role) {
            $q->whereHas('roles', fn($z) => $z->whereIn('roles.id', $role));
        });
    }
}
