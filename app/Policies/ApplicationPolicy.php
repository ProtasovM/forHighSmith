<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    public function get(User $user, Application $application = null): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Application $application): bool
    {
        return false;
    }

    public function delete(User $user, Application $application): bool
    {
        return false;
    }
}
