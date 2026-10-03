<?php

namespace App\Policies;

use App\Models\Story;
use App\Models\User;

class StoryPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['child', 'parent', 'admin'], true);
    }

    public function view(User $user, Story $story): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $story->publication_status === 'published';
    }

    public function update(User $user, Story $story): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Story $story): bool
    {
        return $user->role === 'admin';
    }
}
