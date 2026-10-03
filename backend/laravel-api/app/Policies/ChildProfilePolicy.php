<?php

namespace App\Policies;

use App\Models\ChildProfile;
use App\Models\User;

class ChildProfilePolicy
{
    public function view(User $user, ChildProfile $childProfile): bool
    {
        return $user->role === 'admin' || $childProfile->parent_id === $user->id;
    }

    public function update(User $user, ChildProfile $childProfile): bool
    {
        return $user->role === 'admin' || $childProfile->parent_id === $user->id;
    }
}
