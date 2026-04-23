<?php

namespace App\Policies;

use App\Models\User;

class ActivityPurposePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function manage(User $user): bool
    {
        return $user->can('activity-purpose.manage');
    }
}
