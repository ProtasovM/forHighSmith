<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    public function get(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Application $post): bool
    {
        return false;
    }

    public function delete(User $user, Application $post): bool
    {
        return false;
    }
}
